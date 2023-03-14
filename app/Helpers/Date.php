<?php

if (!function_exists('Jam_Sekarang')) {
    function Jam_Sekarang()
    {
        return date('H:i:s');
    }
}

if (!function_exists('Sekarang')) {
    function Sekarang()
    {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('Hari_Ini')) {
    function Hari_Ini()
    {
        // $today = (new \Carbon\Carbon("today"))->format('Y-m-d');
        return date('Y-m-d');
    }
}

if (!function_exists('Total_Hari')) {
    function Total_Hari()
    {
        return date('t');
    }
}

if (!function_exists('Hari_Ke')) {
    function Hari_Ke()
    {
        return date('d', strtotime(Today()));
    }
}

if (!function_exists('microtimeFormat')) {
    function microtimeFormat($data,$format=null,$lng=null)
    {
        $duration = microtime(true) - $data;
        $hours = (int)($duration/60/60);
        $minutes = (int)($duration/60)-$hours*60;
        $seconds = $duration-$hours*60*60-$minutes*60;
        return number_format((float)$seconds, 2, '.', '').' seconds';
    }
}
