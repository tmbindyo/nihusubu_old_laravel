<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model implements Auditable
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
    public function uploadType()
    {
        return $this->belongsTo('App\UploadType');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function productGroupImages()
    {
        return $this->hasOne('App\ProductGroupImage');
    }
    public function productImages()
    {
        return $this->hasOne('App\ProductImage');
    }
    public function forumUploads()
    {
        return $this->hasOne('App\ForumUpload');
    }
    public function issueUploads()
    {
        return $this->hasOne('App\IssueUpload');
    }
    public function taskUploads()
    {
        return $this->hasOne('App\TaskUpload');
    }
    public function forumPostUploads()
    {
        return $this->hasOne('App\ForumPostUpload');
    }
}
