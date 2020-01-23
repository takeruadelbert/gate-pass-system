<?php


interface RestApi
{
    public static function apiGet($url);

    public static function apiPost($url, $param);

    public static function apiPut($url, $param);

    public static function apiDelete($url, $param);
}