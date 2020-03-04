<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
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
    public function user_account()
    {
        return $this->hasMany('App\UserAccount');
    }
    public function user_type_section()
    {
        return $this->hasMany('App\UserTypeSection');
    }
    public function user_type_menu()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function user_type_feature()
    {
        return $this->hasMany('App\UserTypeFeature');
    }
}
