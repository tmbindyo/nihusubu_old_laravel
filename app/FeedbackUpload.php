<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackUpload extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function feedback()
    {
        return $this->belongsTo('App\Feedback');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function upload()
    {
        return $this->belongsTo('App\Upload');
    }

}
