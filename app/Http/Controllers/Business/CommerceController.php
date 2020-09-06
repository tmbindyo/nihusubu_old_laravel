<?php

namespace App\Http\Controllers\Business;

use App\CommerceTemplate;
use App\CommerceTemplateType;
use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommerceController extends Controller
{

    use UserTrait;
    use InstitutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function commerceTemplates($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get template types
        $commerceTemplateTypes = CommerceTemplateType::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();
        // get templates
        $commerceTemplates = CommerceTemplate::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('commerceTemplateType')->get();
//        return $commerceTemplates;

        return view('business.templates', compact('user', 'institution', 'commerceTemplates', 'commerceTemplateTypes'));
    }
}
