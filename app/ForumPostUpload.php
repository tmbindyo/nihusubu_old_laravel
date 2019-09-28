<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPostUpload extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;
}
