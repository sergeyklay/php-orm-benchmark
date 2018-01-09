<?php

namespace OrmBench\Provider;

use Dms\Core\Ioc\IIocContainer;
use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Util\DateTimeClock;
use Dms\Common\Structure\Web\Html;
use Illuminate\Container\Container;
use OrmBench\Dms\Domain\Entities\Post;
use OrmBench\Dms\Ioc\LaravelIocContainer;
use OrmBench\Dms\Infrastructure\Persistence\DbPostRepository;
use OrmBench\Dms\AppOrm;

class Dms extends AbstractProvider
{
    public function setUp()
    {
        $container = new LaravelIocContainer(new Container());

        $container->bindCallback(IIocContainer::SCOPE_SINGLETON, IConnection::class, function () {
            $config = new \Doctrine\DBAL\Configuration();

            $conn = require_once DOCROOT . '/config/dms.php';

            $connectionParams = [
                'url' => $conn['dsn'],
                'driverOptions' => [
                    \PDO::MYSQL_ATTR_FOUND_ROWS => true
                ],
            ];
            $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

            return new \Dms\Core\Persistence\Db\Doctrine\DoctrineConnection($connection);
        });

        $container->bind(IIocContainer::SCOPE_SINGLETON, IOrm::class, AppOrm::class);

        $this->container = $container;
    }

    public function create()
    {
        $postRepository = $this->container->get(DbPostRepository::class);

        $post = new Post(
            'Yet another article: ' . __CLASS__, 
            new Html('This is the body of the article.'), 
            new DateTimeClock()
        );

        $postRepository->save($post);

        assert(is_numeric($post->getId()));
        assert($post->getId() > 0);

        $this->removePKs[] = $post->getId();
    }

    public function read(int $id)
    {
        $postRepository = $this->container->get(DbPostRepository::class);

        $post = $postRepository->get($id);

        $comments = $post->comments;
        assert($comments[0]->body === 'It is a comment.');
    }
}
