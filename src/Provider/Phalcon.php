<?php

namespace OrmBench\Provider;

use Phalcon\Di;
use Phalcon\Config;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Model\Metadata\Memory;
use OrmBench\Models\Phalcon\Posts;

class Phalcon extends AbstractProvider
{
    public function setUp()
    {
        $di = new Di();

        $di->setShared('modelsManager', Manager::class);
        $di->setShared('modelsMetadata', Memory::class);

        $config = new Config(require_once DOCROOT . '/config/phalcon.php');
        
        $di->setShared(
            'db',
            function () use ($config) {
                return new Mysql($config->database->toArray());
            }
        );

        Di::setDefault($di);
    }

    public function findOne(int $id)
    {
        $post = Posts::findFirst($id);
        assert($post instanceof Posts);

        $comment = $post->getComments(['order' => 'created_at DESC']);
        assert($comment[0]->body === 'It is a comment.');
    }
}
