<?php

namespace OrmBench\Provider;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use OrmBench\Doctrine\Models\Posts;
use Doctrine\Common\Cache\ArrayCache;

class Doctrine extends AbstractProvider
{
    private $em;

    public function setUp()
    {
        $proxyDir = null;
        $cache = null;

        if ($this->isUseMetadataCaching()) {
            $proxyDir = DOCROOT . '/storage/doctrine/proxies';
            $cache = new ArrayCache();
        }

        $config = Setup::createAnnotationMetadataConfiguration(
            [DOCROOT . '/provider/doctrine/Models'],
            false,
            $proxyDir,
            $cache
        );

        $this->em = EntityManager::create(require_once DOCROOT . '/config/doctrine.php', $config);

        if ($this->isUseMetadataCaching()) {
            $reporter->metaDataStorage = 'File System';
            $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
            $this->em->getProxyFactory()->generateProxyClasses($metadatas, $proxyDir);
        }
    }

    public function create()
    {
        $post = new Posts();

        $post->setTitle('Yet another article: ' . __CLASS__);
        $post->setBody('This is the body of the article.');
        $post->setCreatedAt(time());
        $post->setUpdatedAt(time());

        $this->em->persist($post);
        $this->em->flush();

        assert($post instanceof Posts);
        assert(is_numeric($post->getId()));
        assert($post->getId() > 0);
    }

    public function read(int $id)
    {
        $post = $this->em
            ->getRepository(Posts::class)
            ->findOneBy(['id' => $id]);
        
        assert($post instanceof Posts);

        $comments = $post->getComments();
        assert($comments->first()->getBody() === 'It is a comment.');
    }
}
