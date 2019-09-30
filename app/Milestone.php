<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
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

    // Children
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function task_list()
    {
        return $this->hasMany('App\TaskList');
    }
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
}
