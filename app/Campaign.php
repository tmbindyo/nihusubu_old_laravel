<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function campaignType()
    {
        return $this->belongsTo('App\CampaignType');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    // children
    public function campaignUploads()
    {
        return $this->hasMany('App\Upload');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function organizations()
    {
        return $this->hasMany('App\Organization');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

}
