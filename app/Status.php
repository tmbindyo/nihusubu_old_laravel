<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    
    //
    public function communication()
    {
        return $this->hasMany('App\Communication');
    }
    public function communication_type()
    {
        return $this->hasMany('App\CommunicationType');
    }
    public function industry()
    {
        return $this->hasMany('App\Industry');
    }
    public function institution()
    {
        return $this->hasMany('App\Institution');
    }
    public function upload()
    {
        return $this->hasMany('App\Upload');
    }
    public function upload_type()
    {
        return $this->hasMany('App\UploadType');
    }
    public function user_type()
    {
        return $this->hasMany('App\UserType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
