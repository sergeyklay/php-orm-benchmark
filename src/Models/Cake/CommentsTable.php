<?php

namespace OrmBench\Models\Cake;

use Cake\ORM\Table;
use OrmBench\Models\Cake\Entities\Comments;

class CommentsTable extends Table
{
    protected $_table = 'comments';

    public function initialize(array $config)
    {
        $this->setEntityClass(Comments::class);

        $this->belongsTo('Posts', [
            'className'  => PostsTable::class,
            'foreignKey' => 'post_id',
        ]);
    }
}
