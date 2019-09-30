<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
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
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    public function timesheets()
    {
        return $this->hasMany('App\Timesheet');
    }
    public function task_uploads()
    {
        return $this->hasMany('App\TaskUpload');
    }
}
