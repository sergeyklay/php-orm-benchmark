<?php

namespace OrmBench\NextrasOrm\Models;

use Nextras\Orm\Mapper\Mapper;

class CommentsMapper extends Mapper
{
    public function getTableName(): string
    {
        return 'comments';
    }
}
