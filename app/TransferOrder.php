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
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function sourceWarehouse()
    {
        return $this->belongsTo('App\Warehouse', 'source_warehouse_id', 'id');
    }
    public function destinationWarehouse()
    {
        return $this->belongsTo('App\Warehouse', 'destination_warehouse_id', 'id');
    }

    // Children
    public function transferOrderProducts()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
}
