<?php

namespace OrmBench\NextrasOrm\Models;

use Nextras\Orm\Mapper\Mapper;

class PostsMapper extends Mapper
{
    public function getTableName(): string
    {
        return 'posts';
    }
}
