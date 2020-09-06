<?php

namespace App\Http\Controllers\Admin;

use App\Module;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institution;
use App\InstitutionModule;
use App\Subscription;
use App\SubscriptionModule;

class ModuleController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function modules()
    {
        // User
        $user = $this->getUser();
        // modules
        $modules = Module::with('status','user')->get();
        return view('admin.modules', compact('user', 'modules'));
    }

    public function moduleShow($module_id)
    {
        // User
        $user = $this->getUser();
        // get module
        $module = Module::where('id',$module_id)->with('subscriptionModules')->first();

        return view('admin.module_show', compact('user', 'module'));
    }

    public function moduleUpdate(Request $request, $module_id)
    {
        // User
        $user = $this->getUser();
        // get module
        $module = Module::where('id',$module_id)->with('subscriptionModules')->first();
        $module->name = $request->name;
        $module->price = $request->price;
        if($request->is_business == "on"){
            $module->is_business = true;
        }else{
            $module->is_business = false;
        }
        if($request->is_user == "on"){
            $module->is_user = true;
        }else{
            $module->is_user = false;
        }
        if($request->is_paid == "on"){
            $module->is_paid = true;
        }else{
            $module->is_paid = false;
        }

        $module->save();

        return redirect()->route('admin.module.show',$module->id)->withSuccess('Module '.$module->name.' sucessfully updated');
    }
}
