<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
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
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function user_roles()
    {
        return $this->hasMany('App\UserRole');
    }
    public function role_user_type_sections()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
    public function role_user_type_menus()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
    public function role_user_type_features()
    {
        return $this->hasMany('App\RoleUserTypeFeature');
    }
}
