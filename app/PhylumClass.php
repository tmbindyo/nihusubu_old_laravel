<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhylumClass extends Model
{
    //
    use SoftDeletes;

    public function phylum()
    {
        return $this->belongsTo('App\Phylum');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
