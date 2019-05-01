<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    //
    use SoftDeletes;

    public function constituency()
    {
        return $this->belongsTo('App\Constituency');
    }

    public function ward()
    {
        return $this->hasMany('App\Ward');
    }
}
