<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Core\Ioc\IIocContainer;
use Dms\Core\Persistence\Db\Mapping\Definition\Orm\OrmDefinition;
use Dms\Core\Persistence\Db\Mapping\Orm;
use OrmBench\Dms\Domain\Entities\Post;
use OrmBench\Dms\Domain\Entities\Comment;

class BlogOrm extends Orm
{
    /**
     * Defines the object mappers registered in the orm.
     *
     * @param OrmDefinition $orm
     *
     * @return void
     */
    protected function define(OrmDefinition $orm)
    {
        $orm->entities([
            Post::class        => PostMapper::class,
            Comment::class     => CommentMapper::class,
        ]);
    }
}
