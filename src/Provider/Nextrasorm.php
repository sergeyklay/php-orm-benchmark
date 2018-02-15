<?php

namespace OrmBench\Provider;

use Nette\Caching\Cache;
use Nette\Caching\Storages\DevNullStorage;
use Nette\Caching\Storages\FileStorage;
use Nextras\Dbal\Connection;
use Nextras\Orm\Entity\Reflection\MetadataParserFactory;
use Nextras\Orm\Mapper\Dbal\DbalMapperCoordinator;
use Nextras\Orm\Model\Model;
use Nextras\Orm\Model\SimpleModelFactory;
use OrmBench\NextrasOrm\Models\CommentsMapper;
use OrmBench\NextrasOrm\Models\CommentsRepository;
use OrmBench\NextrasOrm\Models\Post;
use OrmBench\NextrasOrm\Models\PostsMapper;
use OrmBench\NextrasOrm\Models\PostsRepository;

class Nextrasorm extends AbstractProvider
{
    /** @var Model */
    private $model;

    public function setUp()
    {
        if ($this->isUseMetadataCaching()) {
            $storage = new FileStorage(DOCROOT . '/storage/nextrasorm/cache'); // metadata will be automatically cached
        } else {
            $storage = new DevNullStorage();
        }
        $cache = new Cache($storage);
        $connection = new Connection(require_once DOCROOT . '/config/nextrasorm.php');
        $mapperCoordinator = new DbalMapperCoordinator($connection);
        $metadataParserFactory = new MetadataParserFactory();

        $simpleModelFactory = new SimpleModelFactory($cache, [
            'posts' => new PostsRepository(new PostsMapper($connection, $mapperCoordinator, $cache)),
            'comments' => new CommentsRepository(new CommentsMapper($connection, $mapperCoordinator, $cache)),
        ], $metadataParserFactory);

        $this->model = $simpleModelFactory->create();
    }

    public function create()
    {
        $post = new Post();

        $post->title = 'Yet another article: ' . __CLASS__;
        $post->body = 'This is the body of the article.';
        $post->createdAt = time();
        $post->updatedAt = time();

        $this->model->persist($post);
        $this->model->flush();

        assert($post instanceof Post);
        assert(is_numeric($post->id));
        assert($post->getPersistedId() > 0);
    }

    public function read(int $id)
    {
        $post = $this->model->getRepositoryForEntity(Post::class)
            ->getById([$id]);

        assert($post instanceof Post);

        $comments = $post->comments;
        assert($comments->get()->fetch()->body === 'It is a comment.');
    }

    public function readBatch(array $ids)
    {
        $posts = $this->model->getRepositoryForEntity(Post::class)
            ->findBy(['id' => $ids]);

        foreach ($posts as $post) {
            assert($post instanceof Post);
            $comments = $post->comments;
            assert($comments->get()->fetch()->body === 'It is a comment.');
        }
    }
}
