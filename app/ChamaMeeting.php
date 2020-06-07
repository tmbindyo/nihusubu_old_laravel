<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChamaMeeting extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function chama()
    {
        return $this->belongsTo('App\Chama');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // children
    public function chamaMeetingMembers()
    {
        return $this->hasMany('App\ChamaMeetingMember','meeting_id');
    }
}
