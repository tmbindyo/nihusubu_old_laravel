<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeSection extends Model implements Auditable
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
    public function userType()
    {
        return $this->belongsTo('App\UserType');
    }
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    // Children
    public function roleUserTypeSection()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
}
