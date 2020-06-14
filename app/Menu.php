<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    protected $fillable = ['name','description','user_id','status_id','section_id','route'];

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    // Children
    public function features()
    {
        return $this->hasMany('App\Feature');
    }
    public function userTypeMenu()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function roleUserTypeMenu()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
}
