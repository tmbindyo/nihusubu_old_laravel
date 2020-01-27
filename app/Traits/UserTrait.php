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
        $userCheck = Auth::user();
        $user = User::where('id',$userCheck->id)->with('user_accounts.status','user_accounts.user_type','user_accounts.institution','active_user_account.user_type','active_user_account.institution','inactive_user_account.user_type','inactive_user_account.institution')->withCount('user_accounts')->first();

        // system defined user
        // $user = User::where('id',3)->first();
        return $user;

    }

}
