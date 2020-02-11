<?php

namespace App\Traits;

use Auth;
use App\Institution;
use App\Traits\UserTrait;
use App\UserAccount;

trait InstitutionTrait
{

    use UserTrait;

    public function getInstitution($portal)
    {


        // system defined user
        $institution = Institution::where('portal',$portal)->with('currency','address','plan')->first();
        if($institution){
            // Get user
            $userCheck = Auth::user();
            // check if user has active account
            $userActiveAccount = UserAccount::where('user_id',$userCheck->id)->where('is_active',True)->first();

            if($userActiveAccount->is_institution != True){
                // deactivate user accounts
                $userAccounts = UserAccount::where('user_id',$userCheck->id)->update(['is_active' => False]);
                Auth::logout();
            }

            return $institution;
        }else{
            // logout user or redirect user
            Auth::logout();
            return redirect()->route('login');
        }

    }

}
