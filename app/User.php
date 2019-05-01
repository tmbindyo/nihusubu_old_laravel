<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    
    use Notifiable;

    public function industries()
    {
        return $this->hasMany('App\Industry');
    }
    public function institutions()
    {
        return $this->hasMany('App\Institution');
    }
    public function investors()
    {
        return $this->hasMany('App\Investor');
    }
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
    public function upload_types()
    {
        return $this->hasMany('App\UploadType');
    }
    public function user_detail()
    {
        return $this->hasOne('App\UserDetail');
    }
    public function user_types()
    {
        return $this->hasMany('App\UserType');
    }
    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
