<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phylum extends Model
{
    //
    use SoftDeletes;

    public function kingdom()
    {
        return $this->belongsTo('App\Kingdom');
    }
    public function phylum_classes()
    {
        return $this->hasMany('App\PhylumClass');
    }
}
