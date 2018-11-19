<?php

//edit by Surya Wono(suryawono@yahoo.co.id)
/**
 * Handle file uploads via XMLHttpRequest
 */
class wonoUploadedForm {

    private $file;
    private $private;

    function __construct($file = null, $private) {
        $this->private = $private;
        $this->file = $file;
    }

    function save($path) {
        if ($this->private) {
            $abs = APP . _PRIVATE_DIR . DS;
        } else {
            $abs = "";
        }
        if (!move_uploaded_file($this->file['tmp_name'], $abs . $path)) {
            return false;
        }
        if ($this->private) {
            chmod($abs . $path, 0777);
        }
        return true;
    }

    function getName() {
        return $this->file['name'];
    }

    function getSize() {
        return $this->file['size'];
    }

}

class qqUploadedFileXhr {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName() {
        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class qqFileUploader {

    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
    private $private;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760, $cakeForm = null, $private = false) {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;
        $this->private = $private;

        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else if (!is_null($cakeForm)) {
            $this->file = new wonoUploadedForm($cakeForm, $private);
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    function handleUpload($uploadDirectory, $replaceOldFile = FALSE) {
        if ($this->private) {
            $abs = APP . _PRIVATE_DIR . DS;
        } else {
            $abs = "";
        }
        if (!is_writable($abs . $uploadDirectory) && !mkdir($abs . $uploadDirectory, 0777, true)) {
            return array('status' => 444, 'message' => "Server error. Upload directory isn't writable.", null);
        }

        if (!$this->file) {
            return array('status' => 440, 'message' => 'Tidak ada file yang diupload', null);
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('status' => 441, 'message' => 'File yang diupload kosong', null);
        }

        if ($size > $this->sizeLimit) {
            return array('status' => 442, 'message' => "File terlalu besar ({$this->formatBytes($size)}). Max ukuran file: {$this->formatBytes($this->sizeLimit)}", null);
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('status' => 443, 'message' => 'Ekstensi file salah, yang diperbolehkan hanya ' . $these . '.', null);
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded

            while (file_exists($abs . $uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99999);
            }
        }

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) {
            return array('status' => 206, 'message' => 'Ok', "data" => array("fileName" => $filename . '.' . $ext, "folder" => $uploadDirectory, "ext" => $ext));
        } else {
            return array('status' => 445, 'message' => 'Fail', null);
        }
    }

}

?>