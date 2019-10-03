<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
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
    public function customer()
    {
        return $this->belongsTo('App\Contact','customer_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function estimate()
    {
        return $this->belongsTo('App\Estimate');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function invoice_products()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
}
