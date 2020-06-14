<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMember extends Model implements Auditable
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
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function projectRole()
    {
        return $this->belongsTo('App\ProjectRole');
    }
    public function member()
    {
        return $this->belongsTo('App\Member','member_id','id');
    }
}
