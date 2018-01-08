<?php

namespace OrmBench\Models\Yii;

use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
    public static $db;

    public static function getDb()
    {
        return static::$db;
    }

    public static function tableName()
    {
        return 'comments';
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
