<?php

return [
    'url'           => 'mysql://enigma:secret@127.0.0.1/orm_benchmark',
    'driverOptions' => [
        PDO::MYSQL_ATTR_FOUND_ROWS => true
    ],
];
