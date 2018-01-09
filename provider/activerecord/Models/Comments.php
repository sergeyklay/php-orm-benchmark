<?php

namespace OrmBench\Activerecord\Models;

use ActiveRecord\Model;

class Comments extends Model
{
    public static $table_name = 'comments';
    public static $primary_key = 'id';

    public static $belong_to = [
        [
            'comments',
            'class_name'  => 'Posts',
            'foreign_key' => 'post_id',
        ]
    ];
}
