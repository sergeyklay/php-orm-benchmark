<?php

namespace OrmBench\Provider;

class ProviderFactory
{
    public static $ormProviders = [
        'phalcon',
        'eloquent',
        'propel',
        'cake',
        'yii',
        'doctrine',
        'activerecord',
    ];

    public static function create(string $name, bool $caching = false): AbstractProvider
    {
        $provider = 'OrmBench\\Provider\\' . ucfirst($name);

        return new $provider($caching);
    }
}
