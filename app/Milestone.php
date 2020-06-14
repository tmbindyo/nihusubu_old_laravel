<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model implements Auditable
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
    public function assignee()
    {
        return $this->belongsTo('App\User','assignee_id','id');
    }

    // Children
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function taskList()
    {
        return $this->hasMany('App\TaskList');
    }
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
}
