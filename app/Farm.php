<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    //
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function family_size()
    {
        return $this->belongsTo('App\FamilySize');
    }
    public function age_cluster()
    {
        return $this->belongsTo('App\AgeCluster');
    }
    public function farm_size()
    {
        return $this->belongsTo('App\FarmSize');
    }
    public function sand_type()
    {
        return $this->belongsTo('App\SandType');
    }
    public function topography()
    {
        return $this->belongsTo('App\Topography');
    }
    public function fertility()
    {
        return $this->belongsTo('App\Fertility');
    }
}
