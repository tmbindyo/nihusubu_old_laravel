<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContactType extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function contact_type()
    {
        return $this->belongsTo('App\ContactType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
