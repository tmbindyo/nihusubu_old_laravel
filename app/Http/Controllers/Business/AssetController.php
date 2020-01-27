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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assets($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.assets',compact('user','institution'));
    }
    public function assetCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.asset_create',compact('user','institution'));
    }
    public function assetStore($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return back()->withSuccess('Asset successfully created!');
    }
    public function assetShow($portal, $asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.asset_show',compact('user','institution'));
    }
    public function assetUpdate($portal, $asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return back()->withSuccess('Asset successfully updated!');
    }
    public function assetDelete($portal, $asset_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return back()->withSuccess('Asset successfully deleted!');
    }
}
