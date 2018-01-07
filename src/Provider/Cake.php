<?php

namespace OrmBench\Provider;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use OrmBench\Models\Cake\PostsTable;
use OrmBench\Models\Cake\Entities\Posts;
use Cake\Datasource\ConnectionManager;

class Cake extends AbstractProvider
{
    public function setUp()
    {
        Configure::write('App.namespace', 'OrmBench');
        ConnectionManager::setConfig('default', require_once DOCROOT . '/config/cake.php');
    }

    public function create()
    {
        $postsTable = TableRegistry::get('Posts', [
            'className' => PostsTable::class,
        ]);

        $post = $postsTable->newEntity();

        $post->title = 'Yet another article: ' . __CLASS__;
        $post->body  = 'This is the body of the article.';
        $post->created_at  = time();
        $post->updated_at  = time();

        assert($postsTable->save($post) instanceof Posts);
        assert(is_numeric($post->id));
        assert($post->id > 0);

        $this->removePKs[] = $post->id;
    }

    public function read(int $id)
    {
        $posts = TableRegistry::get('Posts', [
            'className' => PostsTable::class,
        ]);

        $post = $posts->find('all', [
            'conditions' => ['id' => $id],
            'contain'   => ['Comments'],
        ])->first();

        assert($post instanceof Posts);

        $comments = $post->comments;
        assert($comments[0]->body === 'It is a comment.');
    }
}
