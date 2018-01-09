<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Common\Structure\DateTime\Persistence\DateTimeMapper;
use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use OrmBench\Dms\Models\Post;
use OrmBench\Dms\Models\Comment;

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

        $map->embedded(Post::CREATED_AT)->using(new DateTimeMapper('created_at'));

        $map->embedded(Post::UPDATED_AT)->using(new DateTimeMapper('updated_at'));
    }
}
