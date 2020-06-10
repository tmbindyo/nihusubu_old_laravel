<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function chama()
    {
        return $this->belongsTo('App\Chama');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function chamaMember()
    {
        return $this->belongsTo('App\ChamaMember', 'member_id');
    }
    public function loanType()
    {
        return $this->belongsTo('App\LoanType');
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
