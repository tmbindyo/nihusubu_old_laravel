<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubIndustry extends Model
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
    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }

    // Children
    public function institutionSubIndustries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
}
