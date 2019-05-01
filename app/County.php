<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class County extends Model
{
    //
    use SoftDeletes;

    public function constituency()
    {
        return $this->hasMany('App\Constituency');
    }
}
