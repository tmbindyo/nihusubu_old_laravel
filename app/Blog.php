<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    //
    use SoftDeletes;

    public function blog_type()
    {
        return $this->belongsTo('App\BlogType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function layout()
    {
        return $this->belongsTo('App\Layout');
    }
    public function blog_images()
    {
        return $this->hasMany('App\BlogImage');
    }
    public function blog_tags()
    {
        return $this->hasMany('App\BlogTag');
    }
}
