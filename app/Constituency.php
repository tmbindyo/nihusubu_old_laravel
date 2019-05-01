<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Constituency extends Model
{
    //
    use SoftDeletes;

    public function county()
    {
        return $this->belongsTo('App\County');
    }

    public function location()
    {
        return $this->hasMany('App\Location');
    }
}
