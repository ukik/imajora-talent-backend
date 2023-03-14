<?php

if (!function_exists('Faker')) {
    function Faker(){
        return \Faker\Factory::create();
    }
}

if (!function_exists('Uuid')) {
    function Uuid(){
        return Faker()->uuid;
    }
}

if (!function_exists('make_uuid')) {
    function make_uuid($label = 'CONPAS', $user_id = ''){
        return $label.'-'.$user_id.'-'.prepand_zero(rand(0,100000), 5).'-'.uuid();
    }
}
