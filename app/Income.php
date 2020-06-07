<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function incomeType()
    {
        return $this->belongsTo('App\IncomeType');
    }
    public function frequency()
    {
        return $this->belongsTo('App\Frequency');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function incomeDebits()
    {
        return $this->hasMany('App\IncomeDebit');
    }
}
