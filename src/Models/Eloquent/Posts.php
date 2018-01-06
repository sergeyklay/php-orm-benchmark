<?php

namespace OrmBench\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id')->orderBy('created_at', 'dsc');
    }
}