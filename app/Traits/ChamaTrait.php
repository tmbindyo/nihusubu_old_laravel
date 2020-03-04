<?php

namespace App\Traits;

use App\Chama;
use App\ChamaMember;
use Auth;
use App\User;
use App\UserAccount;

trait ChamaTrait
{


    public function getChama($chama_id)
    {

        // Get user
        $userCheck = Auth::user();

        // check if user is part of chama
        $chama = Chama::where('id',$chama_id)->first();

        // Chama members
        $chamaMembers = ChamaMember::where('chama_id',$chama_id)->where('member_id',$userCheck->id)->first();
        if($chamaMembers){
            return $chama;
        }


    }

}
