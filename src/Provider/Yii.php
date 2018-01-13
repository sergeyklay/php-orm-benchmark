<?php

namespace OrmBench\Provider;

use yii\db\Connection;
use yii\caching\ArrayCache;
use yii\caching\FileCache;
use OrmBench\Yii\Models\Posts;
use OrmBench\Yii\Models\Comments;

class Yii extends AbstractProvider
{
    public function setUp()
    {
        defined('YII_DEBUG') || define('YII_DEBUG', false);
        require_once DOCROOT . '/provider/yii/vendor/yiisoft/yii2/Yii.php';
        $config = require_once DOCROOT . '/config/yii.php';

        $db = new Connection($config['db']);
        $db->enableSchemaCache = true;

        if ($this->isUseMetadataCaching()) {
            $db->schemaCache = new FileCache($config['cache']);
        } else {
            $db->schemaCache = new ArrayCache();
        }

        Posts::$db = $db;
        Comments::$db = $db;
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
    }

    public function read(int $id)
    {
        $post = Posts::findOne(['id' => $id]);
        assert($post instanceof Posts);

        $comments = $post->comments;
        assert($comments[0]->body === 'It is a comment.');
    }

    public function readBatch(array $ids)
    {
        $posts = Posts::find()->where(['id' => $ids])->with('comments')->all();

        foreach ($posts as $post) {
            assert($post instanceof Posts);
            $comments = $post->comments;
            assert($comments[0]->body === 'It is a comment.');
        }
    }
}
