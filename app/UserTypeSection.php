<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeSection extends Model
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
    public function user_type()
    {
        return $this->belongsTo('App\UserType');
    }
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    // Children
    public function role_user_type_section()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
}
