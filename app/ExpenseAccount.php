<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseAccount extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    // Parents
    public function account_type()
    {
        return $this->belongsTo('App\AccountType');
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
