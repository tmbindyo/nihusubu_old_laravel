<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    
    
    //
    public function communication()
    {
        return $this->hasMany('App\Communication');
    }
    public function communication_type()
    {
        return $this->hasMany('App\CommunicationType');
    }
    public function industry()
    {
        return $this->hasMany('App\Industry');
    }
    public function institution()
    {
        return $this->hasMany('App\Institution');
    }
    public function investor()
    {
        return $this->hasMany('App\Investor');
    }
    public function project()
    {
        return $this->hasMany('App\Project');
    }
    public function project_bid()
    {
        return $this->hasMany('App\ProjectBid');
    }
    public function project_investment()
    {
        return $this->hasMany('App\ProjectInvestment');
    }
    public function project_task()
    {
        return $this->hasMany('App\ProjectTask');
    }
    public function project_type()
    {
        return $this->hasMany('App\ProjectType');
    }
    public function requisition()
    {
        return $this->hasMany('App\Requisition');
    }
    public function review()
    {
        return $this->hasMany('App\Review');
    }
    public function review_type()
    {
        return $this->hasMany('App\ReviewType');
    }
    public function upload()
    {
        return $this->hasMany('App\Upload');
    }
    public function user_type()
    {
        return $this->hasMany('App\UserType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
