<?php

namespace App\Traits;

use App\Institution;

trait InstitutionTrait
{


    public function getInstitution()
    {

        // system defined user
        $institution = Institution::where('id','ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68')->first();

        return $institution;
    }

}
