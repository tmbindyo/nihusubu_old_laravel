<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderSetting extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

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
