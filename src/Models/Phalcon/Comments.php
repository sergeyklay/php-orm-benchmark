<?php

namespace OrmBench\Models\Phalcon;

use Phalcon\Mvc\Model;

class Comments extends Model
{
    public function getSource()
    {
        return 'comments';
    }

    public function initialize()
    {
        $this->belongsTo('post_id', Posts::class, 'id');
    }
}
