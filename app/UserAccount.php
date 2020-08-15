<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function userType()
    {
        return $this->belongsTo('App\UserType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function registerer()
    {
        return $this->belongsTo('App\User', 'registerer_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
