<?php

namespace OrmBench\Cake\Models;

use Cake\ORM\Table;
use OrmBench\Cake\Models\Entities\Posts;

class PostsTable extends Table
{
    protected $_table = 'posts';

    public function initialize(array $config)
    {
        $this->setEntityClass(Posts::class);

        $this->hasMany('Comments', [
            'className'    => CommentsTable::class,
            'foreignKey'   => 'post_id',
            'sort'         => ['Comments.created_at' => 'DESC'],
            'propertyName' => 'comments',
        ]);
    }
}
