<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferOrderProduct extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function transfer_order()
    {
        return $this->belongsTo('App\TransferOrder')->with('source_warehouse','destination_warehouse');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
