<?php

namespace OrmBench\Provider;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Dms\Core\Ioc\IIocContainer;
use Dms\Core\Persistence\Db\Doctrine\DoctrineConnection;
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
            $connection = DriverManager::getConnection(
                require_once DOCROOT . '/config/dms.php',
                new Configuration()
            );

            return new DoctrineConnection($connection);
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
    }

    public function read(int $id)
    {
        $postRepository = $this->container->get(DbPostRepository::class);

        $post = $postRepository->get($id);

        $comments = $post->comments;
        assert($comments[0]->body === 'It is a comment.');
    }
}
