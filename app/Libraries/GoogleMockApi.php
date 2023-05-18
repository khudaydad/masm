<?php

namespace App\Libraries;

class GoogleMockApi
{
    // son karakteri tek sayi ise
    public static function verifyReceipt($receipt)
    {
        $lastCharacter = substr($receipt, -1);
        return ($lastCharacter != '' && $lastCharacter % 2 == 1) ? true : false;
    }
}
