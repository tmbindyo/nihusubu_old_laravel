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
    public function userRoles()
    {
        return $this->hasMany('App\UserRole');
    }
    public function roleUserTypeSections()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
    public function roleUserTypeMenus()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
    public function roleUserTypeFeatures()
    {
        return $this->hasMany('App\RoleUserTypeFeature');
    }
}
