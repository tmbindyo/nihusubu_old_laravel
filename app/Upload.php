<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
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
    public function upload_type()
    {
        return $this->belongsTo('App\UploadType');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function product_group_images()
    {
        return $this->hasOne('App\ProductGroupImage');
    }
    public function product_images()
    {
        return $this->hasOne('App\ProductImage');
    }
    public function forum_uploads()
    {
        return $this->hasOne('App\ForumUpload');
    }
    public function issue_uploads()
    {
        return $this->hasOne('App\IssueUpload');
    }
    public function task_uploads()
    {
        return $this->hasOne('App\TaskUpload');
    }
    public function forum_post_uploads()
    {
        return $this->hasOne('App\ForumPostUpload');
    }
}
