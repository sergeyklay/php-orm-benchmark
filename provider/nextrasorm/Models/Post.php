<?php

namespace OrmBench\NextrasOrm\Models;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * @property int                    $id         {primary}
 * @property string                 $title
 * @property string                 $body
 * @property int                    $createdAt
 * @property int                    $updatedAt
 * @property OneHasMany|Comment[] $comments   {1:m Comment::$post}
 */
class Post extends Entity
{
}
