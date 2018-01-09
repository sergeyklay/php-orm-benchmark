<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Common\Structure\Web\Persistence\HtmlMapper;
use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use OrmBench\Dms\Domain\Entities\Comment;
use OrmBench\Dms\Domain\Entities\Post;

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

        $map->property(Post::CREATED_AT)->to('created_at')->asInt();

        $map->property(Post::UPDATED_AT)->to('updated_at')->asInt();
    }
}
