<?php

namespace App\Traits;

use Auth;
use App\User;
use App\UserAccount;

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
        // check if user has active account
        $userActiveAccount = UserAccount::where('user_id',$userCheck->id)->where('is_active',True)->first();
        if(!$userActiveAccount){
            return redirect()->route('view.user.accounts');
        }else{
            $user = User::where('id',$userCheck->id)->with('user_accounts.status','user_accounts.user_type','user_accounts.institution','active_user_account.user_type','active_user_account.institution','inactive_user_account.user_type','inactive_user_account.institution')->withCount('user_accounts')->first();
            return $user;
        }

        // system defined user
        // $user = User::where('id',3)->first();

    }

}
