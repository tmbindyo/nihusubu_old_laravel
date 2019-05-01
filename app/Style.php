<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Style extends Model
{
    //
    use SoftDeletes;

    public function layouts()
    {
        return $this->hasMany('App\Layout');
    }
}
