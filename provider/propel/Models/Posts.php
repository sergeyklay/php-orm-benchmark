<?php

namespace OrmBench\Propel\Models;

use Propel\Runtime\ActiveQuery\Criteria;
use OrmBench\Propel\Models\Base\Posts as BasePosts;

class Posts extends BasePosts
{
    public function getMostRecentComment()
    {
        return CommentsQuery::create()
            ->filterByPosts($this)
            ->orderByCreatedAt(Criteria::DESC)
            ->findOne();
    }
}
