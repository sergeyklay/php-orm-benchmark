<?php

defined('DOCROOT') || define('DOCROOT', dirname(dirname(__FILE__)));

return [
    'database' => [
        'host'      => '127.0.0.1',
        'port'      => 3306,
        'username'  => 'enigma',
        'password'  => 'secret',
        'dbname'    => 'orm_benchmark',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'metadata' => [
        'metaDataDir' => DOCROOT . '/storage/phalcon/metadata/',
    ]
];
