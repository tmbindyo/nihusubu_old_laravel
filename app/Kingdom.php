<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kingdom extends Model
{
    //
    use SoftDeletes;

    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }
    public function phylums()
    {
        return $this->hasMany('App\Phylum');
    }
}
