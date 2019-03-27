<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadType extends Model
{
    use SoftDeletes;
    
    
    //
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
}
