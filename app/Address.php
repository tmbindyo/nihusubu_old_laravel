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
        return $this->belongsTo('App\UserDetail');
    }
    public function institutions()
    {
        return $this->belongsTo('App\Institution');
    }
    public function departments()
    {
        return $this->belongsTo('App\Department');
    }
    public function branches()
    {
        return $this->belongsTo('App\Branch');
    }
}
