<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
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
    public function addressType()
    {
        return $this->belongsTo('App\AddressType');
    }

    // Children
    public function userDetails()
    {
        return $this->hasOne('App\UserDetail');
    }
    public function institutions()
    {
        return $this->hasOne('App\Institution');
    }
    public function departments()
    {
        return $this->hasOne('App\Department');
    }
    public function branches()
    {
        return $this->hasOne('App\Branch');
    }
    public function warehouse()
    {
        return $this->hasOne('App\Warehouse');
    }
    public function contactShippingAddress()
    {
        return $this->hasOne('App\Contact','shipping_address_id','id');
    }
    public function contactBillingAddress()
    {
        return $this->hasOne('App\Contact','billing_address_id','id');
    }
}
