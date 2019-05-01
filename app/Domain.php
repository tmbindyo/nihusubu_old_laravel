<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    //
    use SoftDeletes;

    public function kingdoms()
    {
        return $this->hasMany('App\Kigdom');
    }
}
