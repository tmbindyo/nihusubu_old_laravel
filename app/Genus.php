<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Genus extends Model
{
    //
    use SoftDeletes;

    public function family()
    {
        return $this->belongsTo('App\Family');
    }
    public function species()
    {
        return $this->hasMany('App\Species');
    }
}
