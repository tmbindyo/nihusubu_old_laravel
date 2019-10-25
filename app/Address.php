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
    public function address_type()
    {
        return $this->belongsTo('App\AddressType');
    }

    // Children
    public function user_details()
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
    public function contact_shipping_address()
    {
        return $this->hasOne('App\Contact','shipping_address_id','id');
    }
    public function contact_billing_address()
    {
        return $this->hasOne('App\Contact','billing_address_id','id');
    }
}
