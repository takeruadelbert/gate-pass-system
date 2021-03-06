<?php

App::uses('RestApi', 'Controller/Interface');

class ApiController implements RestApi
{
    private static $apiHeader = [
        'Content-Type: application/json'
    ];
    private static $curlDefaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLINFO_HEADER_OUT => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ];
    private static $HTTP_REQUEST_METHOD_DELETE = "DELETE";
    private static $HTTP_REQUEST_METHOD_PUT = "PUT";
    private static $HTTP_REQUEST_METHOD_GET = "GET";

    public static function apiGet($url, $header = [], $param = "{}", $timeout = _DEFAULT_TIMEOUT)
    {
        $options = [
            CURLOPT_HTTPHEADER => self::setupHeader($header),
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => self::$HTTP_REQUEST_METHOD_GET,
            CURLOPT_POSTFIELDS => self::encodeDataParam($param),
            CURLOPT_TIMEOUT => $timeout,
        ];
        return self::apiConnect($options);
    }

    public static function apiPost($url, $param = "", $header = [], $timeout = _DEFAULT_TIMEOUT)
    {
        $options = [
            CURLOPT_HTTPHEADER => self::setupHeader($header),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => self::encodeDataParam($param),
            CURLOPT_URL => $url,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => $timeout,
        ];
        return self::apiConnect($options);
    }

    public static function apiPut($url, $param = "", $header = [], $timeout = _DEFAULT_TIMEOUT)
    {
        $options = [
            CURLOPT_HTTPHEADER => self::setupHeader($header),
            CURLOPT_CUSTOMREQUEST => self::$HTTP_REQUEST_METHOD_PUT,
            CURLOPT_POSTFIELDS => self::encodeDataParam($param),
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => $timeout,
        ];
        return self::apiConnect($options);
    }

    public static function apiDelete($url, $param = "", $header = [], $timeout = _DEFAULT_TIMEOUT)
    {
        $options = [
            CURLOPT_HTTPHEADER => self::setupHeader($header),
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => self::$HTTP_REQUEST_METHOD_DELETE,
            CURLOPT_POSTFIELDS => self::encodeDataParam($param),
            CURLOPT_TIMEOUT => $timeout,
        ];
        return self::apiConnect($options);
    }

    private static function apiConnect($options = [])
    {
        try {
            $ch = curl_init();
            curl_setopt_array($ch, self::$curlDefaultOptions + $options);

            $result = curl_exec($ch);
            $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $err = curl_error($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_size);
            $body = substr($result, $header_size);
            curl_close($ch);

            if ($result === false || !empty($err)) {
                $body = $err;
            }
            return [
                "http_response_code" => $httpResponseCode,
                "header" => $header,
                "body_response" => $body
            ];
        } catch (Exception $ex) {
            return [
                "http_response_code" => 500,
                "header" => null,
                "body_response" => $ex->getMessage()
            ];
        }
    }

    private static function encodeDataParam($data)
    {
        return !empty($data) ? json_encode($data) : "[]";
    }

    private static function setupHeader($header)
    {
        $mergedHeader = self::$apiHeader;
        if (!empty($header)) {
            $mergedHeader = array_merge($mergedHeader, $header);
        }
        return $mergedHeader;
    }
}