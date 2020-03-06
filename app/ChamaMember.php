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
    public function chama_member_meetings()
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
    public function shares_payments()
    {
        return $this->hasMany('App\SharesPayment','member_id');
    }
    public function welfare()
    {
        return $this->hasMany('App\Welfare','member_id');
    }
}
