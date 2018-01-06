<?php

namespace OrmBench\Models\Phalcon;

use Phalcon\Mvc\Model;

class Posts extends Model
{
    public function getSource()
    {
        return 'posts';
    }

    public function initialize()
    {
        $this->hasMany('id', Comments::class, 'post_id', ['alias' => 'comments']);
    }
}
