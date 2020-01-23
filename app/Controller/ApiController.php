<?php


class ApiController implements RestApi
{
    private static $header = [
        'Content-Type: application/ x-www-form-urlencoded'
    ];
    private static $HTTP_REQUEST_METHOD_DELETE = "Delete";

    public static function apiGet($url)
    {
        try {
            $options = [
                CURLOPT_HTTPHEADER => self::$header,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ];
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $result = curl_exec($ch);
            curl_close($ch);

            if ($result === false) {
                return "Error occurred.";
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function apiPost($url, $param = "")
    {
        try {
            $options = [
                CURLOPT_HTTPHEADER => self::header,
                CURLOPT_POSTFIELDS => json_encode($param),
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ];
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $result = curl_exec($ch);
            curl_close($ch);

            if ($result === false) {
                return "Error occurred.";
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function apiPut($url, $param = "")
    {
        return self::apiPost($url, $param);
    }

    public static function apiDelete($url, $param = "")
    {
        try {
            $options = [
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => self::$HTTP_REQUEST_METHOD_DELETE,
                CURLOPT_POSTFIELDS => json_encode($param),
                CURLOPT_RETURNTRANSFER => true
            ];
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}