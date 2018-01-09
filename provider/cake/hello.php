<?php
require __DIR__ . '/vendor/autoload.php';

use OrmBench\Cake\Models\PostsTable;
use Cake\ORM\TableRegistry;

$postsTable = TableRegistry::get('Posts', [
    'className' => PostsTable::class,
]);
