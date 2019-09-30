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

    // Children
    public function estimate_customers()
    {
        return $this->belongsTo('App\Estimate','customer_id');
    }
    public function invoice_customers()
    {
        return $this->belongsTo('App\Invoice','customer_id');
    }
    public function order_customers()
    {
        return $this->belongsTo('App\Order','customer_id');
    }
    public function sale_customers()
    {
        return $this->belongsTo('App\Sale','customer_id');
    }
    public function project_customers()
    {
        return $this->belongsTo('App\Project','customer_id');
    }
    public function expense_customers()
    {
        return $this->belongsTo('App\Expense','customer_id');
    }
}
