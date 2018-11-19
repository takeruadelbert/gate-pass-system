<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

    var $hari = array(
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu"
    );

    function Rp($Rp) {
        if ($Rp == "") {
            return "Rp. 0";
        }
        return "Rp. " . number_format($Rp, 0, "", ".") . ",-";
    }

    function cvtTanggal($date = null, $now = true) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
        } else if ($now) {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
        } else {
            return "-";
        }
        return "$tgl $bulan $tahun";
    }

    function periodeInd($periode = null) {
        $p = explode("/", $periode);
        return $this->cvtTanggal($p[0]) . " - " . $this->cvtTanggal($p[1]);
    }

    function cvtHariTanggal($date = null, $now = true) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
            $hari = $this->hari[date("w", strtotime($date))];
        } else if ($now) {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
            $hari = $this->hari[date("w")];
        } else {
            return "-";
        }
        return "$hari, $tgl $bulan $tahun";
    }
    function cvtHari($date = null, $now = true) {
        if (!empty($date)) {
            $hari = $this->hari[date("w", strtotime($date))];
        } else if ($now) {
            $hari = $this->hari[date("w")];
        } else {
            return "-";
        }
        return "$hari";
    }

    function cvtJam($date = null) {
        if (!empty($date)) {
            $jam = date("H", strtotime($date));
            $menit = date("i", strtotime($date));
        } else {
            $jam = date("H");
            $menit = date("i");
        }
        return "$jam:$menit";
    }

    function cvtWaktu($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
            $jam = date("H", strtotime($date));
            $menit = date("i", strtotime($date));
        } else {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
            $jam = date("H");
            $menit = date("i");
        }
        return "$tgl $bulan $tahun - $jam:$menit";
    }

    function getTanggal($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
        } else {
            $tgl = date("d");
        }
        return "$tgl";
    }

    function getBulan($date = null) {
        if (!empty($date)) {
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
        } else {
            $bulan = $this->getNamaBulan(date("m"));
        }
        return $bulan;
    }

    function getTahun($date = null) {
        if (!empty($date)) {
            $tahun = date("Y", strtotime($date));
        } else {
            $tahun = date("Y");
        }
        return "$tahun";
    }

    function getNamaBulan($i = null) {
        if ($i == 1) {
            $monthName = 'Januari';
        } elseif ($i == 2) {
            $monthName = 'Februari';
        } elseif ($i == 3) {
            $monthName = 'Maret';
        } elseif ($i == 4) {
            $monthName = 'April';
        } elseif ($i == 5) {
            $monthName = 'Mei';
        } elseif ($i == 6) {
            $monthName = 'Juni';
        } elseif ($i == 7) {
            $monthName = 'Juli';
        } elseif ($i == 8) {
            $monthName = 'Agustus';
        } elseif ($i == 9) {
            $monthName = 'September';
        } elseif ($i == 10) {
            $monthName = 'Oktober';
        } elseif ($i == 11) {
            $monthName = 'Nopember';
        } else {
            $monthName = 'Desember';
        }
        return $monthName;
    }

    function getEkstensi($inExt = null) {
        if ($inExt == 'doc') {
            $result = 'Word';
        } else if ($inExt == 'docx') {
            $result = 'Word';
        } else if ($inExt == 'xls') {
            $result = 'Excel';
        } else if ($inExt == 'xlsx') {
            $result = 'Excel';
        } else if ($inExt == 'docx') {
            $result = 'Word';
        } else if ($inExt == 'pdf') {
            $result = 'Pdf';
        } else if ($inExt == 'ppt') {
            $result = 'Power Point';
        } else if ($inExt == 'pptx') {
            $result = 'Power Point';
        } else if ($inExt == 'jpg') {
            $result = 'Image';
        } else if ($inExt == 'jpeg') {
            $result = 'Image';
        } else if ($inExt == 'png') {
            $result = 'Image';
        }

        return $result;
    }

    function println($string = false) {
        if ($string === false) {
            return "<br/>";
        } else if (empty($string)) {
            return "";
        } else {
            return "$string<br/>";
        }
    }

    function changeStatusSelect($id, $options = array(), $default = null, $url = "", $e = null) {
        $result = "<select onchange=changeStatus($id,$(this).val(),'$url','$e') class='select-full'>";
        foreach ($options as $k => $v) {
            if ($k == $default) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $result.="<option value='$k' $selected>{$v}</option>";
        }
        return $result . "</select>";
    }

    function cekKeterlambatan($time = null) {
        if ($time <= 0) {
            $result = 0;
        } else {
            $result = $time;
        }
        return $result;
    }

    function convertJam($time = null) {
        $result = $time / 3600;
        return $result;
    }

    //source
    //http://stackoverflow.com/questions/3534533/output-is-in-seconds-convert-to-hhmmss-format-in-php
    function toHHMMSS($seconds = 0) {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
    }

    function getUmur($date = null) {
//        return intval(date('Y',time()-strtotime($date))) - 1970;
//        $now = date("Y-m-d");
//        $interval = $now->diff($date);
//        return $interval->y;
//        $age = floor((strtotime($date) - strtotime($now)) / 31556926);
//        debug($date);
//        die;

        $from = new DateTime($date);
        $to = new DateTime();
        return $from->diff($to)->y;
//        return $result;
    }

    function getKenaikanPangkat($date = null) {
        $time = strtotime($date);
        $tmt_year = date("Y", $time);
        $curr_year = date("Y");
//        debug($curr_year);
//        die;
//        return ceil((strtotime($curr_year)-strtotime($tmt_year))/4);
        return ceil($curr_year - $tmt_year) / 4;
    }

    function getKenaikanGaji($date = null) {
        $time = strtotime($date);
        $tmt_year = date("Y", $time);
        $curr_year = date("Y");
//        debug($curr_year);
//        die;
//        return ceil((strtotime($curr_year)-strtotime($tmt_year))/4);
        return ceil($curr_year - $tmt_year) / 2;
    }

    function addYearsPangkat($date = null) {
        $enddate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " + 4 year"));
        return $enddate;
    }

    function addYearsGaji($date = null) {
        $enddate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " + 2 year"));
        return $enddate;
    }

    //http://stackoverflow.com/questions/11481737/how-to-calculate-time-ago-in-php
    function getTimeago($ptime) {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return 'kurang dari 1 detik yang lalu';
        }

        $a = array(12 * 30 * 24 * 60 * 60 => 'tahun',
            30 * 24 * 60 * 60 => 'bulan',
            24 * 60 * 60 => 'hari',
            60 * 60 => 'jam',
            60 => 'menit',
            1 => 'detik'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;

            if ($d >= 1) {
                $r = round($d);
                return 'sekitar ' . $r . ' ' . $str . ' lalu';
            }
        }
    }

}
