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
        $userCheck = Auth::user();
        $user = User::where('id',$userCheck->id)->with('userAccounts.status','userAccounts.userType','userAccounts.institution','activeUserAccount.userType','activeUserAccount.institution','inactiveUserAccount.userType','inactiveUserAccount.institution','currentUserAccounts.userType','currentUserAccounts.institution')->withCount('userAccounts')->first();
        return $user;
    }

    public function getUser()
    {

        // Get user
        $userCheck = Auth::user();
        // check if user has active account
        $userActiveAccount = UserAccount::where('user_id',$userCheck->id)->where('is_active',true)->first();
        if(!$userActiveAccount){
            return redirect()->route('view.user.accounts');
        }else{
            $user = User::where('id',$userCheck->id)->with('userAccounts.status','userAccounts.userType','userAccounts.institution','activeUserAccount.userType','activeUserAccount.institution','inactiveUserAccount.userType','inactiveUserAccount.institution','currentUserAccounts.userType','currentUserAccounts.institution')->withCount('userAccounts')->first();
            return $user;
        }


    }

}
