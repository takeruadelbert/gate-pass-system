<?php

/*
 * Model Behavior
 * purpose  : saving multi language into single fields using json format
 * written  : Surya Wono(suryawono@yahoo.co.id)
 * standard : user ISO 639-2/5 as language code
 */

class IndonesiaConversionBehavior extends ModelBehavior {

    public $suffix = "__ic";
    public $config = [];
    public $hari = array(
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu"
    );
    public $bulan = [
        1 => "Januari",
        2 => "Febuari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    ];

    public function setup(Model $Model, $config = array()) {
        $this->config = $config;
    }

    function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);
        foreach ($results as $i => $result) {
            $results[$i] = $this->_proccess($result);
        }
        return $results;
    }

    function _proccess($o = null, $name = null, $grandName = null) {
        foreach ($o as $k => $v) {
            if (is_array($v)) {
                $o[$k] = $this->_proccess($v, $k, $name);
            } else {
                $needle = $name;
                if (is_int($name)) {
                    $needle = $grandName;
                }
                if (is_string($k) && isset($this->config[$needle]) && array_key_exists($k, $this->config[$needle])) {
                    switch ($this->config[$needle][$k]['type']) {
                        case "date":
                            $o[$k . $this->suffix] = $this->_cvtHariTanggal($v);
                            break;
                        case "dateonly":
                            $o[$k . $this->suffix] = $this->_cvtHariTanggal($v, true);
                            break;
                    }
                }
            }
        }
        return $o;
    }

    function _cvtHariTanggal($date, $dateonly = false) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->bulan[date("n", strtotime($date))];
            $tahun = date("Y", strtotime($date));
            $hari = $this->hari[date("w", strtotime($date))];
        } else {
            return "-";
        }
        if ($dateonly) {
            return "$tgl $bulan $tahun";
        } else {
            return "$hari, $tgl $bulan $tahun";
        }
    }

}
