<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function payment_term()
    {
        return $this->belongsTo('App\PaymentTerm');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function billing_address()
    {
        return $this->belongsTo('App\Address','billing_address_id','id');
    }
    public function shipping_address()
    {
        return $this->belongsTo('App\Address','shipping_address_id','id');
    }

    // Children
    public function estimate_customers()
    {
        return $this->belongsTo('App\Estimate','customer_id','id');
    }
    public function invoice_customers()
    {
        return $this->belongsTo('App\Invoice','customer_id','id');
    }
    public function order_customers()
    {
        return $this->belongsTo('App\Order','customer_id','id');
    }
    public function sale_customers()
    {
        return $this->belongsTo('App\Sale','customer_id','id');
    }
    public function project_customers()
    {
        return $this->belongsTo('App\Project','customer_id','id');
    }
    public function expense_customers()
    {
        return $this->belongsTo('App\Expense','customer_id','id');
    }
}
