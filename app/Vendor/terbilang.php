<?php
// Written by: Suhendi
// Email: suhendi888@yahoo.co.id
// Param : Integer yang akan diubah menjadi bentuk ejaan
// Return Val : String yang merupakan bentuk ejaan dari Integer semula
function angka2kalimat($integer) {
	$result = "";
	$units = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
	$ten = "puluh";
	$tenSuffix = "belas";
	$hundred = "ratus";
	$thousand = "ribu";
	$million = "juta";
	$billion = "miliar";
	$trillion = "triliun";
	$prefix = array("", "se", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ");
	$str = (string)$integer;
	$len = strlen($str);
	for ($x=0; $x<$len; $x++) {
		$addition = "";
		$position = $len - $x;
		$int = intval(substr($str, $x, 1));
		if ($int > 0) {
			if (($position % 3 == 2) and (intval(substr($str, $x + 1, 1)) != 0) and ($int == 1)) {
				$addition .= $prefix[intval(substr($str, $x + 1, 1))].$tenSuffix;
			} else if (($position % 3 != 1) or ($x == 0) or (($position % 3 == 1) and (intval(substr($str, $x - 1, 1)) != 1))) {
				if (($position % 3 == 0) or ((($position <= 4) and ($x == 0)) and ($position > 1)) or (($position % 3 == 2) and ($int == 1))) {
					$addition .= $prefix[$int];
				} else {
					$addition .= $units[$int]." ";
				}
			}
			if (($position == 2) and ((intval(substr($str, $x + 1, 1)) == 0) or ($int != 1))) {
				$addition .= $ten;
			} else if ($position == 3) {
				$addition .= $hundred;
			} else if ($position == 4) {
				$addition .= $thousand;
			} else if (($position == 5) and ((intval(substr($str, $x + 1, 1)) == 0) or ($int != 1))) {
				$addition .= $ten;
				$int2 = intval(substr($str, $x+1, 1));
				if ($int2 == 0) {
					$addition .= " ".$thousand;
				}
			} else if ($position == 6) {
				$addition .= $hundred;
				$int2 = intval(substr($str, $x+1, 1));
				$int3 = intval(substr($str, $x+2, 1));
				if (($int2 == 0) and ($int3 == 0)) {
					$addition .= " ".$thousand;
				}
			} else if ($position == 7) {
				$addition .= $million;
			} else if (($position == 8) and ((intval(substr($str, $x + 1, 1)) == 0) or ($int != 1))) {
				$addition .= $ten;
				$int2 = intval(substr($str, $x+1, 1));
				if ($int2 == 0) {
					$addition .= " ".$million;
				}
			} else if ($position == 9) {
				$addition .= $hundred;
				$int2 = intval(substr($str, $x+1, 1));
				$int3 = intval(substr($str, $x+2, 1));
				if (($int2 == 0) and ($int3 == 0)) {
					$addition .= " ".$million;
				}
			} else if ($position == 10) {
				$addition .= $billion;
			} else if (($position == 11) and ((intval(substr($str, $x + 1, 1)) == 0) or ($int != 1))) {
				$addition .= $ten;
				$int2 = intval(substr($str, $x+1, 1));
				if ($int2 == 0) {
					$addition .= " ".$billion;
				}
			} else if ($position == 12) {
				$addition .= $hundred;
				$int2 = intval(substr($str, $x+1, 1));
				$int3 = intval(substr($str, $x+2, 1));
				if (($int2 == 0) and ($int3 == 0)) {
					$addition .= " ".$billion;
				}
			} else if ($position == 13) {
				$addition .= $trillion;
			} else if (($position == 14) and ((intval(substr($str, $x + 1, 1)) == 0) or ($int != 1))) {
				$addition .= $ten;
				$int2 = intval(substr($str, $x+1, 1));
				if ($int2 == 0) {
					$addition .= " ".$trillion;
				}
			} else if ($position == 15) {
				$addition .= $hundred;
				$int2 = intval(substr($str, $x+1, 1));
				$int3 = intval(substr($str, $x+2, 1));
				if (($int2 == 0) and ($int3 == 0)) {
					$addition .= " ".$trillion;
				}
			}
			if ($position > 1) {
				$addition .= " ";
			}
		}
		$result .= $addition;
	}
	return $result;
}
?>