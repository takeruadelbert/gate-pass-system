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
class EchoHelper extends HtmlHelper {

    var $bulan = [
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
        12 => "Desember"];

    function empty_strip($s) {
        if (empty($s)) {
            return '-';
        }
        return $s;
    }

    function fullName($biodata = false) {
        if ($biodata) {
            return rtrim($biodata['gelar_depan'] . " " . $biodata['first_name'] . " " . $biodata['last_name'] . ", " . $biodata['gelar_belakang'], ", ");
        }
        return "";
    }

    function userGroup($user_group_id = false) {
        $userGroupName = ClassRegistry::init("UserGroup")->find("list", array("fields" => array("UserGroup.id", "UserGroup.label")));
        if ($user_group_id) {
            return $userGroupName[$user_group_id];
        }
        return "";
    }

    function department($department_id = false) {
        $departmentName = ClassRegistry::init("Department")->find("list", array("fields" => array("Department.id", "Department.name")));
        if ($department_id) {
            return $departmentName[$department_id];
        }
        return "";
    }

    function city($city_id = false) {
        $city = ClassRegistry::init("City")->find("list", array("fields" => array("City.id", "City.name")));
        if ($city) {
            return $city[$city_id];
        }
        return "";
    }

    function state($state_id = false) {
        $state = ClassRegistry::init("State")->find("list", array("fields" => array("State.id", "State.name")));
        if ($state) {
            return $state[$state_id];
        }
        return "";
    }

    function country($country_id = false) {
        $country = ClassRegistry::init("Country")->find("list", array("fields" => array("Country.id", "Country.name")));
        if ($country) {
            return $country[$country_id];
        }
        return "";
    }

    function periodeBulan() {
        return $this->bulan;
    }

    function periodeTahun() {
        $tahun = [];
        for ($i = date("Y"); $i >= 1900; $i--) {
            $tahun[$i] = $i;
        }
        return $tahun;
    }

    function bulanToTriwulan($bulan) {
        switch ($bulan) {
            case ($bulan <= 3):
                $triwulan = "I";
                break;
            case ($bulan <= 6):
                $triwulan = "II";
                break;
            case ($bulan <= 9):
                $triwulan = "III";
                break;
            case ($bulan <= 12):
                $triwulan = "IV";
                break;
            default:
                $triwulan = "";
                break;
        }
        return $triwulan;
    }

    function rangeBulan($s, $e) {
        $r = [];
        for (; $s <= $e; $s++) {
            $r[] = $this->bulan[$s];
        }
        return $r;
    }

    function laporanPeriodeBulan($awal, $akhir) {
        $tglAwal = date("d", strtotime($awal));
        $bulanAwal = $this->getNamaBulan(date("m", strtotime($awal)));
        $tahunAwal = date("Y", strtotime($awal));
        $tglAkhir = date("d", strtotime($akhir));
        $bulanAkhir = $this->getNamaBulan(date("m", strtotime($akhir)));
        $tahunAkhir = date("Y", strtotime($akhir));

        if (strtotime($awal) == strtotime($akhir)) {
            return "$tglAwal $bulanAwal $tahunAwal";
        } else {
            return "$tglAwal $bulanAwal $tahunAwal - $tglAkhir $bulanAkhir $tahunAkhir";
        }
    }

}
