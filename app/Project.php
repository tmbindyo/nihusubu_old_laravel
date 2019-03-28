<?php

namespace App;

use Auth;
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
    public function ongoing_project_bids() {
        return $this->project_bids()->where('user_id','=', Auth::user()->id)->where('status_id','=', 1);
    }
    public function bid_project_bids() {
        return $this->project_bids()->where('user_id','!=', Auth::user()->id)->where('status_id','=', 1);
    }
    public function opportunity_project_bids() {
        return $this->project_bids()->where('user_id','!=', Auth::user()->id);
    }
    public function portfolio_project_bids() {
        return $this->project_bids()->where('user_id','=', Auth::user()->id);
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
