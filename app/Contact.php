<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function contact_type()
    {
        return $this->belongsTo('App\ContactType');
    }
    public function lead_source()
    {
        return $this->belongsTo('App\LeadSource');
    }
    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function title()
    {
        return $this->belongsTo('App\Title');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function contact_contact_types()
    {
        return $this->hasMany('App\ContactContactType');
    }
    public function liabilities()
    {
        return $this->hasMany('App\Liability');
    }
    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
}
