<?php

namespace OrmBench\Provider;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use OrmBench\Cake\Models\PostsTable;
use OrmBench\Cake\Models\Entities\Posts;
use Cake\Datasource\ConnectionManager;

class Cake extends AbstractProvider
{
    public function setUp()
    {
        Configure::write('App.namespace', 'OrmBench');

        $config = require_once DOCROOT . '/config/cake.php';

        if ($this->isUseMetadataCaching()) {
            $reporter->metaDataStorage = 'File System';
            Cache::setConfig('_cake_model_', $config['metadata']);
            $config['database']['cacheMetadata'] = true;
        }

        ConnectionManager::setConfig('default', $config['database']);
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
