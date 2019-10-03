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
    public function customer_type()
    {
        return $this->belongsTo('App\CustomerType');
    }
    public function contact_type()
    {
        return $this->belongsTo('App\ContactType');
    }
    public function salutation()
    {
        return $this->belongsTo('App\Salutation');
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
