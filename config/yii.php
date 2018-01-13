<?php

defined('DOCROOT') || define('DOCROOT', dirname(dirname(__FILE__)));

return [
    'db' => [
        'dsn'      => 'mysql:host=127.0.0.1;port=3306;dbname=orm_benchmark',
        'username' => 'enigma',
        'password' => 'secret',
        'charset'  => 'utf8',
    ],
    'cache' => [
        'cachePath' => DOCROOT . '/storage/yii/metadata'
    ]
];
