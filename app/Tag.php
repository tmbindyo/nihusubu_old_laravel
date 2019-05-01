<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    //
    use SoftDeletes;

    public function blog_tags()
    {
        return $this->hasMany('App\BlogTag');
    }
}
