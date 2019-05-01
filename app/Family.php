<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    //
    use SoftDeletes;

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function genera()
    {
        return $this->hasMany('App\Genus');
    }
}
