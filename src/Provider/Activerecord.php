<?php

namespace OrmBench\Provider;

use ActiveRecord\Config;    
use OrmBench\Activerecord\Models\Posts;

class Activerecord extends AbstractProvider
{
    public function setUp()
    {
        $config = require_once DOCROOT . '/config/activerecord.php';

        Config::initialize(function (Config $configurator) use ($config) {
            $configurator->set_model_directory(DOCROOT . '/src/Models/Activerecord');
            $configurator->set_connections([
                'development' => $config['dsn'],
            ]);
        });
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
        $post = Posts::first(['id' => $id]);
        assert($post instanceof Posts);

        $comments = $post->comments;
        assert($comments[0]->body === 'It is a comment.');
    }
}
