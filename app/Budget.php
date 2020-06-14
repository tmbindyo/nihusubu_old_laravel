<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function expenseAccount()
    {
        return $this->belongsTo('App\ExpenseAccount');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
