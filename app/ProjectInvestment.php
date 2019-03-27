<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectInvestment extends Model
{
    use SoftDeletes;
    
    
    //
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function investor()
    {
        return $this->belongsTo('App\Investor');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
