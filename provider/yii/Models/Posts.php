<?php

namespace OrmBench\Yii\Models;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public static $db;

    public static function getDb()
    {
        return static::$db;
    }

    public static function tableName()
    {
        return 'posts';
    }

    public function getComments()
    {
        return $this
            ->hasMany(Comments::className(), ['post_id' => 'id'])
            ->orderBy(['created_at' => SORT_DESC]);
    }
}
