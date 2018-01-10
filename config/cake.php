<?php

use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Cache\Engine\FileEngine;

defined('DOCROOT') || define('DOCROOT', dirname(dirname(__FILE__)));

return [
    'database' => [
        'className'     => Connection::class,
        'driver'        => Mysql::class,
        'host'          => '127.0.0.1',
        'port'          => 3306,
        'database'      => 'orm_benchmark',
        'username'      => 'enigma',
        'password'      => 'secret',
        'encoding'      => 'utf8',
        'cacheMetadata' => false,
        'log'           => false,
    ],
    'metadata' => [
        'className' => FileEngine::class,
        'duration'  => '+1 year',
        'path'      => DOCROOT . '/storage/cake/metadata',
        'prefix'    => 'benchmark_'
    ],
];
