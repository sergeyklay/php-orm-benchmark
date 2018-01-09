<?php

namespace OrmBench\Phalcon\Models;

use Phalcon\Mvc\Model;

/**
 * @method Comments[] getComments($params = null)
 *
 * @package OrmBench\Phalcon\Models
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
