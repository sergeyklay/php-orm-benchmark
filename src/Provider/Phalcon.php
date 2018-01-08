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
                return new Mysql($config->offsetGet('database')->toArray());
            }
        );

        Di::setDefault($di);
    }

    public function create()
    {
        $post = new Posts();

        $post->title = 'Yet another article: ' . __CLASS__;
        $post->body  = 'This is the body of the article.';
        $post->created_at  = time();
        $post->updated_at  = time();

        assert($post->save() === true);
        assert(is_numeric($post->id));
        assert($post->id > 0);

        $this->removePKs[] = $post->id;
    }

    public function read(int $id)
    {
        $post = Posts::findFirst($id);
        assert($post instanceof Posts);

        $comments = $post->getComments(['order' => 'created_at DESC']);
        assert($comments[0]->body === 'It is a comment.');
    }
}
