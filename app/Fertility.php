<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fertility extends Model
{
    //
    use SoftDeletes;

    public function farms()
    {
        return $this->hasMany('App\Farm');
    }
    public function fertility_type()
    {
        return $this->belongsTo('App\FertilityType');
    }
}
