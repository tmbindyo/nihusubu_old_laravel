<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChamaMember extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function chama()
    {
        return $this->belongsTo('App\Chama');
    }
    public function chama_member_role()
    {
        return $this->belongsTo('App\ChamaMemberRole','member_role_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
