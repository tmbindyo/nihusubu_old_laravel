<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    // Parents
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
