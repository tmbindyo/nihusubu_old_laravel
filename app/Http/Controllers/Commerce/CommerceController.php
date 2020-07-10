<?php

namespace App\Http\Controllers\Commerce;

use App\CommerceTemplateFile;
use App\CommerceTemplateType;
use App\Traits\InstitutionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommerceController extends Controller
{

    use institutionTrait;

    public function cart ($portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        // check if institution can view this page

        // check if the template has this file

        // get the
        $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','cart')->first();

        return view($commerceFile->view,compact('institution'));
    }

    public function checkout ($portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        // check if institution can view this page

        // check if the template has this file

        // get the
        $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','checkout')->first();

        return view($commerceFile->view,compact('institution'));
    }

    public function index ($portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        // check if institution can view this page

        // check if the template has this file

        // get the
        $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','index')->first();

        return view($commerceFile->view,compact('institution'));
    }

    public function productDetail ($portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        // check if institution can view this page

        // check if the template has this file

        // get the
        $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','product-details')->first();

        return view($commerceFile->view,compact('institution'));
    }

    public function shop ($portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        // check if institution can view this page

        // check if the template has this file

        // get the
        $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','shop')->first();

        return view($commerceFile->view,compact('institution'));
    }
}
