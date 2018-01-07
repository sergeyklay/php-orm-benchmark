<?php

namespace OrmBench\Models\Propel;

use Propel\Runtime\ActiveQuery\Criteria;
use OrmBench\Models\Propel\Base\Posts as BasePosts;

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
