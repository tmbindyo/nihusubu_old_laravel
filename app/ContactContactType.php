<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContactType extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
    public function contactType()
    {
        return $this->belongsTo('App\ContactType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
