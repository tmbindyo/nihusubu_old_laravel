<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ChamaMeetingMember extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function chamaMeeting()
    {
        return $this->belongsTo('App\ChamaMeeting','meeting_id');
    }
    public function chamaMember()
    {
        return $this->belongsTo('App\ChamaMember');
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
