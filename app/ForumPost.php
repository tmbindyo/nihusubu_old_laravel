<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function forum()
    {
        return $this->belongsTo('App\Forum');
    }
    public function parent()
    {
        return $this->belongsTo('App\ForumPost', 'parent_id', 'id');
    }

    // Children
    public function forumPostUploads()
    {
        return $this->hasMany('App\ForumPostUpload');
    }
}
