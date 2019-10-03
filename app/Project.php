<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
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
    public function customer()
    {
        return $this->belongsTo('App\Contact','customer_id','id');
    }
    public function owner()
    {
        return $this->belongsTo('App\User','owner_id','id');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function project_owner()
    {
        return $this->belongsTo('App\User','project_owner','id');
    }

    // Children
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function estimates()
    {
        return $this->hasMany('App\Estimate');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function milestones()
    {
        return $this->hasMany('App\Milestone');
    }
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function task_lists()
    {
        return $this->hasMany('App\TaskList');
    }
    public function project_members()
    {
        return $this->hasMany('App\ProjectMember');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function forums()
    {
        return $this->hasMany('App\Forum');
    }
}
