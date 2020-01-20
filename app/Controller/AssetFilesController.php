<?php

App::uses('AppController', 'Controller');

class AssetFilesController extends AppController {

    var $name = "AssetFiles";
    var $disabledAction = array(
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_getfile($id = null, $token = null) {
        if (isset($this->request->query['dl']) && $this->request->query['dl']==0){
            $download=false;
        }else{
            $download=true;
        }
        $file = $this->AssetFile->find("first", array(
            "conditions" => array(
                "AssetFile.id" => $id,
                "AssetFile.token" => $token,
            )
        ));
        if (!empty($file)) {
            if ($file['AssetFile']['is_private']) {
                $this->response->file(APP . _PRIVATE_DIR . DS . $file['AssetFile']['folder'] . $file['AssetFile']['filename'], array(
                    'download' => $download,
                    "name" => $file['AssetFile']['filename'],
                ));
                $hit = $file['AssetFile']['hit'];
                $hit++;
                $this->AssetFile->id = $file['AssetFile']['id'];
                $this->AssetFile->data['AssetFile']['hit'] = $hit;
                $this->AssetFile->save();
                return $this->response;
            }
        }
    }

    function admin_upload() {
        $this->layout = false;
        $this->autoRender = false;
        if ($this->request->is("post")) {
            App::import("Vendor", "qqUploader");
            $allowedExt = array("doc", "docx", "pdf","jpg", "jpeg", "png");
            $size = 10 * 1024 * 1024;
            $uploader = new qqFileUploader($allowedExt, $size, $this->data['file'], true);
            $result = $uploader->handleUpload("file" . DS);
            switch ($result['status']) {
                case 206:
                    $this->AssetFile->data['AssetFile'] = array(
                        "folder" => $result['data']['folder'],
                        "filename" => $result['data']['fileName'],
                        "ext" => $result['data']['ext'],
                        "is_private" => true,
                    );
                    $this->AssetFile->save();
                    echo json_encode($this->_generateStatusCode(206, null, ["asset_file_id" => $this->AssetFile->getLastInsertId()]));
                    break;
                case 443:
                    echo json_encode($this->_generateStatusCode(405, null, ["error" => $result['message']]));
                    break;
            }
        }
    }

}
