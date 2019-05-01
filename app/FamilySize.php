<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilySize extends Model
{
    //
    use SoftDeletes;

    public function farms()
    {
        return $this->hasMany('App\Farm');
    }
}
