<?php

namespace OrmBench\Models\Cake;

use Cake\ORM\Table;
use OrmBench\Models\Cake\Entities\Posts;

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
