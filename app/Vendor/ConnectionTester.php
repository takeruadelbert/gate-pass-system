<?php

class ConnectionTester {

    function testIP4($ip, $p) {
        $address = "$ip"; //your public IP
        $port = $p; // your IP open port
        $fp = @fsockopen($address, $port, $errno, $errstr, 10);
        @stream_set_timeout($fp, 1);
        if ($fp) {
            return true;
        } else {
            return false;
        }
        $info = stream_get_meta_data($fp);
        if ($info['timed_out']) {
            return false;
        }
    }

}
