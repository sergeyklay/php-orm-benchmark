<?php

namespace OrmBench\Models\Phalcon;

use Phalcon\Mvc\Model;

/**
 * @method Comments[] getComments($params = null)
 * @package OrmBench\Models\Phalcon
 */
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
