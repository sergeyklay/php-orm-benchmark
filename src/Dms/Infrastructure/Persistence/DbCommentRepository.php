<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use OrmBench\Dms\Domain\Entities\Comment;
use OrmBench\Dms\Domain\Services\Persistence\ICommentRepository;

class DbCommentRepository extends DbRepository implements ICommentRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Comment::class));
    }
}
