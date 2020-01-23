<?php

namespace App\Traits;

use App\Institution;

trait InstitutionTrait
{


    public function getInstitution($portal)
    {

        // system defined user
        $institution = Institution::where('portal',$portal)->with('currency','address')->first();

        return $institution;
    }

}
