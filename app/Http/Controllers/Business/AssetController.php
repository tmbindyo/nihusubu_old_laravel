<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function assets()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.assets',compact('user','institution'));
    }
    public function assetCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.asset_create',compact('user','institution'));
    }
    public function assetStore()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Asset successfully created!');
    }
    public function assetShow($asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.asset_show',compact('user','institution'));
    }
    public function assetUpdate($asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Asset successfully updated!');
    }
    public function assetDelete($asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Asset successfully deleted!');
    }
}
