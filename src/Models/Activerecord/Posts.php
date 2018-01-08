<?php

namespace OrmBench\Models\Activerecord;

use ActiveRecord\Model;

class Posts extends Model
{
    public static $table_name = 'posts';
    public static $primary_key = 'id';

    public static $has_many = [
        [
            'comments',
            'class_name'  => 'Comments',
            'foreign_key' => 'post_id',
        ]
    ];
}
