<?php

namespace OrmBench\Provider;

use OrmBench\Propel\Models\Posts;
use OrmBench\Propel\Models\PostsQuery;
use Propel\Runtime\Propel as PropelRuntime;
use Propel\Runtime\Connection\ConnectionManagerSingle;

class Propel extends AbstractProvider
{
    public function setUp()
    {
        $config = require_once DOCROOT . '/config/propel.php';

        $serviceContainer = PropelRuntime::getServiceContainer();
        $serviceContainer->checkVersion('2.0.0-dev');
        $serviceContainer->setAdapterClass('default', 'mysql');

        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration($config);
        $manager->setName('default');

        $serviceContainer->setConnectionManager('default', $manager);
        $serviceContainer->setDefaultDatasource('default');
    }

    public function create()
    {
        $post = new Posts();

        $post->setTitle('Yet another article: ' . __CLASS__);
        $post->setBody('This is the body of the article.');
        $post->setCreatedAt(time());
        $post->setUpdatedAt(time());

        assert($post->save() === 1);
        assert(is_numeric($post->getId()));
        assert($post->getId() > 0);
    }

    public function read(int $id)
    {
        $post = PostsQuery::create()->findPk($id);
        assert($post instanceof Posts);

        $comment = $post->getMostRecentComment();
        assert($comment->getBody() === 'It is a comment.');
    }
}
