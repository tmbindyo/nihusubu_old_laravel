<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function purchaseOrders()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.purchase_orders',compact('user','institution'));
    }
    public function purchaseOrderCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.purchase_order_create',compact('user','institution'));
    }
    public function purchaseOrderStore(Request $request)
    {
        return back()->withSuccess(__('Purchase order successfully created.'));
    }
    public function purchaseOrderShow($purchase_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.purchase_order_show',compact('user','institution'));
    }

    public function vendors()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.vendors',compact('user','institution'));
    }
    public function vendorCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.vendor_create',compact('user','institution'));
    }
    public function vendorStore(Request $request)
    {
        return back()->withSuccess(__('Vendor successfully created.'));
    }
    public function vendorShow($vendor_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.vendor_show',compact('user','institution'));
    }
    public function vendorContactPersonShow($contact_person_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.vendor_contact_person_show',compact('user','institution'));
    }
    public function vendorContactPersonMessage($contact_person_id)
    {
        return back()->withSuccess(__('Message sent to .'));
    }
    public function vendorEdit()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.vendor_edit',compact('user','institution'));
    }
    public function vendorUpdate(Request $request, $vendor_id)
    {
        return back()->withSuccess(__('Vendor successfully updated.'));
    }
    public function vendorDelete($vendor_id)
    {
        return back()->withSuccess(__('Vendor successfully deleted.'));
    }

    public function expenses()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expenses',compact('user','institution'));
    }
    public function expenseCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expense_create',compact('user','institution'));
    }
    public function expenseStore()
    {
        return back()->withSuccess(__('Expense successfully created.'));
    }
    public function expenseShow($expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expense_show',compact('user','institution'));
    }
    public function expenseEdit($expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expense_show',compact('user','institution'));
    }
    public function expenseUpdate($expense_id)
    {
        return back()->withSuccess(__('Expense successfully updated.'));
    }
    public function expenseDelete($expense_id)
    {
        return back()->withSuccess(__('Expense successfully deleted.'));
    }
    public function expensePrint($expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expense_print',compact('user','institution'));
    }

    public function bills()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.bills',compact('user','institution'));
    }
    public function billCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.bill_create',compact('user','institution'));
    }
    public function billStore()
    {
        return back()->withSuccess(__('Bill successfully created.'));
    }
    public function billShow($bill_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.bill_show',compact('user','institution'));
    }
    public function billEdit($bill_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.bill_edit',compact('user','institution'));
    }
    public function billUpdate($bill_id)
    {
        return back()->withSuccess(__('Bill successfully updated.'));
    }
    public function billDelete($bill_id)
    {
        return back()->withSuccess(__('Bill successfully deleted.'));
    }
    public function billPrint($bill_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.bill_print',compact('user','institution'));
    }

    public function paymentsMade()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payments_made',compact('user','institution'));
    }

    public function expenseSettings()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.expense_settings',compact('user','institution'));
    }
}
