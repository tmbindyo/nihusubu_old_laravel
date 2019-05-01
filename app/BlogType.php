<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogType extends Model
{
    //
    use SoftDeletes;

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
