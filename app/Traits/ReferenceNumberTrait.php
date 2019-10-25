<?php
/**
 * Created by PhpStorm.
 * User: amutis
 * Date: 2019-06-01
 * Time: 11:15
 */

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait ReferenceNumberTrait
{

    // todo generate random string to work as reference numbers
    public function getRandomString($size)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $size; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }
}
