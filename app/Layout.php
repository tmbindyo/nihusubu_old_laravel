<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layout extends Model
{
    //
    use SoftDeletes;

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
    public function style()
    {
        return $this->belongsTo('App\Style');
    }
}
