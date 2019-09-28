<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseItem extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;
}
