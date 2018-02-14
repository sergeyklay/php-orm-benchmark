<?php

namespace OrmBench\NextrasOrm\Models;

use Nextras\Orm\Repository\Repository;

class CommentsRepository extends Repository
{

    /**
     * Returns possible entity class names for current repository.
     * @return string[]
     */
    public static function getEntityClassNames(): array
    {
        return [Comment::class];
    }
}
