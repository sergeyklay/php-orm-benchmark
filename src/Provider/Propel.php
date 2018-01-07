<?php

namespace OrmBench\Provider;

use OrmBench\Models\Propel\Posts;
use OrmBench\Models\Propel\PostsQuery;
use Propel\Runtime\Propel as PropelRuntime;
use Propel\Runtime\Connection\ConnectionManagerSingle;

class Propel extends AbstractProvider
{
    public function setUp()
    {
        require_once DOCROOT . '/config/propel.php';

        $serviceContainer = PropelRuntime::getServiceContainer();
        $serviceContainer->checkVersion('2.0.0-dev');
        $serviceContainer->setAdapterClass('default', 'mysql');

        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration(require DOCROOT . '/config/propel.php');
        $manager->setName('default');

        $serviceContainer->setConnectionManager('default', $manager);
        $serviceContainer->setDefaultDatasource('default');
    }

    public function read(int $id)
    {
        $post = PostsQuery::create()->findPk($id);
        assert($post instanceof Posts);

        $comment = $post->getMostRecentComment();
        assert($comment->getBody() === 'It is a comment.');
    }
}
