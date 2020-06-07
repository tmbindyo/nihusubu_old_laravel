<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estimate extends Model
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
    public function customer()
    {
        return $this->belongsTo('App\Contact','customer_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function estimateProducts()
    {
        return $this->hasMany('App\EstimateProduct');
    }
}
