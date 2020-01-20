<?php

function e_isset($o) {
    return isset($o) ? $o : "-";
}

function emptyToStrip($o) {
    return !empty($o) ? $o : "-";
}

function hargaAkhir($hargaAwal, $discount = -1, $promo = -1, $promoType = -1, $promoCondition = -1) {
    if ($discount > 0) {
        switch ($promoCondition) {
            case 1:
                $discountAmount = $discount * $hargaAwal / 100;
                $harga = $hargaAwal - $discountAmount;
                if ($promoType == 2) {
                    $harga-=$promo;
                    if ($harga < 0) {
                        $harga = 0;
                    }
                } else if ($promoType == 1) {
                    $harga = $harga - ($promo * $harga / 100);
                }
                return $harga;
            case 2:
                if ($promoType == 2) {
                    $harga = $hargaAwal - $promo;
                    if ($harga < 0) {
                        $harga = 0;
                    }
                    return $harga;
                } else if ($promoType == 1) {
                    return $hargaAwal - ($promo * $hargaAwal / 100);
                }
                break;
            case 3:
            case null:
                $discountAmount = $discount * $hargaAwal / 100;
                $harga = $hargaAwal - $discountAmount;
                return $harga;
                break;
        }
    } else {
        if ($promoType == 2) {
            $harga = $hargaAwal - $promo;
            if ($harga < 0) {
                $harga = 0;
            }
            return $harga;
        } else if ($promoType == 1) {
            return $hargaAwal - ($promo * $hargaAwal / 100);
        } else {
            return $hargaAwal;
        }
    }
}

//source
//http://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
function createDateRangeArray($strDateFrom, $strDateTo) {
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.
    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = array();

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

function issetAndNotEmpty($e) {
    return isset($e) && !empty($e) ? $e : null;
}

//http://stackoverflow.com/questions/28720068/split-weeks-between-two-date-range
function splitWeeks() {
    $date = date("Y-m-01");
    $end_date = date("Y-m-t");
//    debug($end_date);
//    die;
    $array_final = array();
    $array = array();
    $i = 0;
    while (strtotime($date) <= strtotime($end_date)) {
        if ($i % 7 == 0 && $i > 0) {
            array_push($array_final, $array);
            $array = array();
        }

        array_push($array, $date);

        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
//        $date = date("Y-m-d", strtotime("+1 day", $date));
        $i++;
    }

    if ($i % 7 != 0) {
        array_push($array_final, $array);
    }
//    debug($array_final);
//    die;
    return $array_final;
}

//http://stackoverflow.com/questions/14994941/numbers-to-roman-numbers-with-php
function romanic_number($integer, $upcase = true) {
    $table = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $return = '';
    while ($integer > 0) {
        foreach ($table as $rom => $arb) {
            if ($integer >= $arb) {
                $integer -= $arb;
                $return .= $rom;
                break;
            }
        }
    }

    return $return;
}

//http://stackoverflow.com/questions/1252693/using-str-replace-so-that-it-only-acts-on-the-first-match
function str_replace_first($from, $to, $subject)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $subject, 1);
}