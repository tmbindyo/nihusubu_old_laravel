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

        // get user
        // check if active
        // User
        // $user = $this->getUser();
        // $activeUserAccount = UserAccount::where('is_active',True)->where('user_id',$user->id)->first();
        // if(!$activeUserAccount){
        //     // if user account active
        //     return redirect()->route('view.user.accounts');
        // }


        // system defined user
        $institution = Institution::where('portal',$portal)->with('currency','address')->first();
        if($institution){
            return $institution;
        }else{
            // logout user or redirect user
            Auth::logout();
            return redirect()->route('login');
        }

    }

}
