<?php

if (!function_exists('generateToken')) {
    function generateToken()
    {
        return md5(rand());
    }
}

if (!function_exists('generateReceipt')) {
    function generateReceipt()
    {
        return date('YmdHis');
    }
}
