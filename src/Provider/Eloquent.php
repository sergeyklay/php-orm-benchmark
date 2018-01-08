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

    public function create()
    {
        $post = new Posts();

        $post->title = 'Yet another article: ' . __CLASS__;
        $post->body  = 'This is the body of the article.';
        $post->created_at  = time();
        $post->updated_at  = time();

        assert($post->save());
        assert(is_numeric($post->id));
        assert($post->id > 0);

        $this->removePKs[] = $post->id;
    }

    public function read(int $id)
    {
        $post = Posts::firstOrFail($id);
        assert($post instanceof Posts);

        $comment = $post->comments;
        assert($comment[0]->body === 'It is a comment.');
    }
}
