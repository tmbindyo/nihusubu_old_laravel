<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use App\Http\Controllers\Controller;
use App\Institution;

class InstitutionController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function institutions()
    {
        // User
        $user = $this->getUser();
        // institutions
        $institutions = Institution::with('plan', 'user', 'status')->get();
        return view('admin.institutions', compact('user', 'institutions'));
    }

    public function institutionShow($institution_id)
    {
        // User
        $user = $this->getUser();
        // institutions
        $institution = Institution::where('id',$institution_id)->with('subscriptions.subscriptionModules', 'user', 'status', 'institutionModules', 'compositeProducts', 'productGroups.productGroupProducts', 'items', 'products', 'warehouses', 'transferOrders', 'inventoryAdjustments', 'campaigns', 'contacts', 'organizations', 'estimates', 'invoices', 'sales', 'orders', 'expenses', 'loans', 'payments', 'refunds', 'transfers')->first();

        return view('admin.institution_show', compact('user', 'institution'));
    }
}
