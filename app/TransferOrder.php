<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferOrder extends Model
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
    public function source_warehouse()
    {
        return $this->belongsTo('App\Warehouse','source_warehouse_id','id');
    }
    public function destination_warehouse()
    {
        return $this->belongsTo('App\Warehouse','destination_warehouse_id','id');
    }

    // Children
    public function transfer_order_products()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
}
