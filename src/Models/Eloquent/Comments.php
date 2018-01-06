<?php

namespace OrmBench\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}