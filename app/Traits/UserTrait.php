<?php

namespace App\Traits;

use Auth;
use App\User;

trait UserTrait
{

    public function getAdmin()
    {
        // Get user
        $user = Auth::user();
        return $user;
    }

    public function getUser()
    {
        // Get user
        $user = Auth::user();

        // system defined user
        $user = User::where('id',3)->first();
        return $user;
    }

}
