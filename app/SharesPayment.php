<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharesPayment extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function chama()
    {
        return $this->belongsTo('App\Chama');
    }
    public function chamaMember()
    {
        return $this->belongsTo('App\ChamaMember', 'member_id');
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
