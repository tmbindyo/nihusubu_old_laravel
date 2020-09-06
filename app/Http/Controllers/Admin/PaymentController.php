<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubscriptionPayment;

class PaymentController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payments()
    {
        // User
        $user = $this->getUser();
        // institutions
        $subscriptionPayments = SubscriptionPayment::with('subscriptionType', 'subscription.institution', 'status', 'user')->get();
        return view('admin.payments', compact('user', 'subscriptionPayments'));
    }
}
