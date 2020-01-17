<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function assignee()
    {
        return $this->belongsTo('App\User','assignee_id', 'id');
    }
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }
    public function product_group()
    {
        return $this->belongsTo('App\ProductGroup');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }


    // Children
}
