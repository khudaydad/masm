<?php

namespace App\Libraries;

class IosMockApi
{
    // son karakteri cift sayi ise
    public static function verifyReceipt($receipt)
    {
        $lastCharacter = substr($receipt, -1);
        return ($lastCharacter != '' && $lastCharacter % 2 == 0) ? true : false;
    }
}
