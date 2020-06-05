<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
