<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parent
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // children
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
        ->selectRaw('module_id,SUM(amount)')
        ->groupBy('module_id');
    }
}
