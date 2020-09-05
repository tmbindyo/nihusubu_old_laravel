<?php

namespace App\Traits;
use App\Product;

trait PasswordTrait
{
    public function printThis()
    {
        echo "Trait executed";
        dd($this);
    }

    public function generatePassword()
    {

        $length = 10;

        # 1). Year was generated
        $year = date("Y");

        # 2). Random string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        # 3). Unique auto-generated (5 digit numeric code)
        $random_string = substr(md5(rand()), 0, 5);

        # 4). Month policy was issued
        $month = date("m");

        $password = $year . $randomString . $random_string . $month;
        return $password;
    }

    public function generateString()
    {
        # 3). Unique auto-generated (5 digit numeric code)
        $random_string = substr(md5(rand()), 0, 15);
        return $random_string;
    }


    public function generatePin()
    {

        # 1). Unique auto-generated (4 digit numeric code)
        $digits = 4;
        $random_string = rand(pow(10, $digits-1), pow(10, $digits)-1);

        return $random_string;
    }
}
