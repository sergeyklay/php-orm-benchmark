<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use Dms\Common\Structure\DateTime\Persistence\DateTimeMapper;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;
use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use OrmBench\Dms\Models\Post;
use OrmBench\Dms\Models\Comment;

class PostMapper extends EntityMapper
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
        $map->type(Post::class);

        $map->toTable('posts');

        $map->idToPrimaryKey('id');

        $map->relation(Post::COMMENTS)
            ->to(Comment::class)
            ->toMany()
            ->identifying()
            ->withBidirectionalRelation(Comment::POST)
            ->orderByDesc('created_at')
            ->withParentIdAs($map->getOrm()->getNamespace() . 'post_id');

        $map->property(Post::TITLE)->to('title')->asVarchar(255);        

        $map->embedded(Post::BODY)->withIssetColumn('body')->using(HtmlMapper::withLongText('body'));

        $map->embedded(Post::CREATED_AT)->using(new DateTimeMapper('created_at'));

        $map->embedded(Post::UPDATED_AT)->using(new DateTimeMapper('updated_at'));
    }
}
