<?php

use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;

return [
    'className'     => Connection::class,
    'driver'        => Mysql::class,
    'host'          => 'mysql',
    'port'          => 3306,
    'database'      => 'orm_benchmark',
    'username'      => 'enigma',
    'password'      => 'secret',
    'encoding'      => 'utf8',
    'cacheMetadata' => false,
    'log'           => false,
];
