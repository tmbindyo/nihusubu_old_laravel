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
    public function income_type()
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
}
