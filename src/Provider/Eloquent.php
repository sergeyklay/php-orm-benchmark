<?php

namespace OrmBench\Provider;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use OrmBench\Models\Eloquent\Posts;

class Eloquent extends AbstractProvider
{
    public function setUp()
    {
        $capsule = new Capsule();

        $capsule->addConnection(require_once DOCROOT . '/config/eloquent.php');

        $capsule->setEventDispatcher(new Dispatcher(new Container()));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function read(int $id)
    {
        $post = Posts::findOrFail($id);
        assert($post instanceof Posts);

        $comment = $post->comments;
        assert($comment[0]->body === 'It is a comment.');
    }
}
