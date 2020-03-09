<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    protected $fillable = ['name','description','user_id','status_id','section_id'];

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
    public function user_type_menu()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function role_user_type_menu()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
}
