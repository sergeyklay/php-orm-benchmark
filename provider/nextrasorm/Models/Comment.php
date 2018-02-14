<?php

namespace OrmBench\NextrasOrm\Models;

use Nextras\Orm\Entity\Entity;

/**
 * @property int                    $id                 {primary}
 * @property string                 $title
 * @property string                 $body
 * @property int                    $createdAt
 * @property int                    $updatedAt
 * @property Post                   $post               {m:1 Post::$comments}
 */
class Comment extends Entity
{
}
