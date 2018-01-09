<?php declare(strict_types = 1);

namespace OrmBench\Dms\Infrastructure\Persistence;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use OrmBench\Dms\Domain\Entities\Post;
use OrmBench\Dms\Domain\Services\Persistence\IPostRepository;

class DbPostRepository extends DbRepository implements IPostRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Post::class));
    }
}
