<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChamaMember extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function chama()
    {
        return $this->belongsTo('App\Chama');
    }
    public function chamaMemberRole()
    {
        return $this->belongsTo('App\ChamaMemberRole','member_role_id');
    }
    public function member()
    {
        return $this->belongsTo('App\User','member_id');
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
    public function chamaMemberMeetings()
    {
        return $this->hasMany('App\ChamaMeetingMember');
    }
    public function loans()
    {
        return $this->hasMany('App\Loan','member_id');
    }
    public function penalties()
    {
        return $this->hasMany('App\Penalty','member_id');
    }
    public function sharesPayments()
    {
        return $this->hasMany('App\SharesPayment','member_id');
    }
    public function welfare()
    {
        return $this->hasMany('App\Welfare','member_id');
    }
}
