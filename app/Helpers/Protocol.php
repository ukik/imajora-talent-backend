<?php

if (!function_exists('is_iframe')) {
    function is_iframe()
    {
        return isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe';
    }
}

if (!function_exists('SchemeAndHttpHost')) {
    function SchemeAndHttpHost()
    {
    	return request()->getSchemeAndHttpHost();
    }
}

if (!function_exists('host')) {
    function host()
    {
        return request()->getHost();
    	// return SchemeAndHttpHost();
    }
}

if (!function_exists('getMyUrl')) {
    function getMyUrl()
    {
      $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
      $server = $_SERVER['SERVER_NAME'];
      $port = $_SERVER['SERVER_PORT'] ? ':'.$_SERVER['SERVER_PORT'] : '';
      return $protocol.$server.$port;
    }
}

