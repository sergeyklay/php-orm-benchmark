<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use OrmBench\Dms\Domain\Entities\Comment;
use OrmBench\Dms\Domain\Entities\Post;

class CommentMapper extends EntityMapper
{
    /**
     * Defines the entity mapper
     *
     * @param MapperDefinition $map
     *
     * @return void
     */
    protected function define(MapperDefinition $map)
    {
        $map->type(Comment::class);

        $map->toTable('comments');

        $map->idToPrimaryKey('id');

        $map->column($map->getOrm()->getNamespace() . 'post_id')->asUnsignedInt();
        $map->relation(Comment::POST)
            ->to(Post::class)
            ->manyToOne()
            ->withBidirectionalRelation(Post::COMMENTS)
            ->withRelatedIdAs($map->getOrm()->getNamespace() . 'post_id');

        $map->property(Comment::BODY)->to('body')->asText();

        $map->property(Comment::CREATED_AT)->to('created_at')->asInt();

        $map->property(Comment::UPDATED_AT)->to('updated_at')->asInt();
    }
}
