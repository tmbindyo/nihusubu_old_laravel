<?php

namespace App\Traits;

use Auth;
use App\Institution;
use App\UserAccount;

trait InstitutionTrait
{


    public function getInstitution($portal)
    {


        // system defined user
        $institution = Institution::where('portal',$portal)->with('currency', 'address', 'plan', 'institutionModules.module', 'institutionModuleNames')->first();
        if($institution){
            // Get user
            $userCheck = Auth::user();
            // check if user has active account
            $userActiveAccount = UserAccount::where('user_id',$userCheck->id)->where('is_active',true)->first();

            if($userActiveAccount->is_institution != true){
                // deactivate user accounts
                $userAccounts = UserAccount::where('user_id',$userCheck->id)->update(['is_active' => false]);
                Auth::logout();
            }

            return $institution;
        }else{
            // logout user or redirect user
            Auth::logout();
            return redirect()->route('login');
        }

    }

    public function getPublicInstitution($portal)
    {

        $institution = Institution::where('portal',$portal)->with('currency','address','plan','commerceTemplate.commerceTemplateFiles')->first();
        return $institution;

    }

}
