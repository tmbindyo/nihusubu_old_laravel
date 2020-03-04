<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeDebit extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // children
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function income()
    {
        return $this->belongsTo('App\Income');
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
