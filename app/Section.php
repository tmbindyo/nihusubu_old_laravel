<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    protected $fillable = ['name','description','user_id','status_id','is_business'];

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
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
    public function userTypeSections()
    {
        return $this->hasMany('App\UserTypeSection');
    }
    public function roleUserTypeSections()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
}
