<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function assets()
    {
        return view('business.assets');
    }
    public function assetCreate()
    {
        return view('business.asset_create');
    }
    public function assetStore()
    {
        return back()->withStatus(__('Asset successfully created.'));
    }
    public function assetShow($asset_id)
    {
        return view('business.asset_show');
    }
    public function assetEdit($asset_id)
    {
        return view('business.asset_show');
    }
    public function assetUpdate($asset_id)
    {
        return back()->withStatus(__('Asset successfully updated.'));
    }
    public function assetDelete($asset_id)
    {
        return back()->withStatus(__('Asset successfully deleted.'));
    }
}
