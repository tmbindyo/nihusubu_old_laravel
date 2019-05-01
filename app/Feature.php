<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    //
    use SoftDeletes;

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public function ward()
    {
        return $this->hasMany('App\Ward');
    }
}
