<?php

namespace OrmBench\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id')->orderBy('created_at', 'dsc');
    }
}
