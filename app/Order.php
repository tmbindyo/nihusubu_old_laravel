<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;

    public function phylum_class()
    {
        return $this->belongsTo('App\PhylumClass');
    }
    public function orders()
    {
        return $this->hasMany('App\Orders');
    }
}
