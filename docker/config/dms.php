<?php

return [
    'url'           => 'mysql://enigma:secret@mysql/orm_benchmark',
    'driverOptions' => [
        PDO::MYSQL_ATTR_FOUND_ROWS => true
    ],
];
