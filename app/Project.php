<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    //
    public function project_bids()
    {
        return $this->hasMany('App\ProjectBid');
    }
    public function project_investments()
    {
        return $this->hasMany('App\ProjectInvestment');
    }
    public function project_tasks()
    {
        return $this->hasMany('App\ProjectTasks');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function project_type()
    {
        return $this->belongsTo('App\ProjectType');
    }
}
