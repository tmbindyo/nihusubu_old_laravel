<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FertilityType extends Model
{
    //
    use SoftDeletes;

    public function fertilities()
    {
        return $this->hasMany('App\Fertility');
    }
}
