<?php

use Propel\Runtime\Connection\ConnectionWrapper;

return [
    'classname' => ConnectionWrapper::class,
    'dsn'       => 'mysql:host=mysql;port=3306;dbname=orm_benchmark',
    'user'      => 'enigma',
    'password'  => 'secret',
    'settings'  => [
        'charset' => 'utf8',
    ],
    'model_paths' => [
        dirname(dirname(__FILE__)) . '/src/Models/Propel',
    ],
];
