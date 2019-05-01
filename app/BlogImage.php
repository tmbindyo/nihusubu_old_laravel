<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogImage extends Model
{
    //
    use SoftDeletes;

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
}
