<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
    public function userAccount()
    {
        return $this->hasMany('App\UserAccount');
    }
    public function userTypeSection()
    {
        return $this->hasMany('App\UserTypeSection');
    }
    public function userTypeMenu()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function userTypeFeature()
    {
        return $this->hasMany('App\UserTypeFeature');
    }
}
