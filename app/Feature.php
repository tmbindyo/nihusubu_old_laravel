<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model implements Auditable
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
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    // Children
    public function userTypeFeatures()
    {
        return $this->hasMany('App\UserTypeFeature');
    }
    public function roleUserTypeFeatures()
    {
        return $this->hasMany('App\RoleUserTypeFeature');
    }
}
