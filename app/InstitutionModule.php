<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionModule extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parent
    public function module()
    {
        return $this->belongsTo('App\Module');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function subscriptionModules()
    {
        return $this->hasMany('App\SubscriptionModule');
    }
    public function totalSubsciption()
    {
        return $this->hasMany('App\SubscriptionModule')
            ->selectRaw('subscription_id,SUM(amount) as totalSubsciption')
            ->groupBy('subscription_id');
    }
    public function groupTry()
    {
        return $this->hasMany('App\SubscriptionModule')
            ->groupBy('subscription_id');
    }

}
