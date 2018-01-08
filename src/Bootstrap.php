<?php

namespace OrmBench;

class Bootstrap
{
    public static $ormProviders = [
        'phalcon',
        'eloquent',
        'propel',
        'cake',
        'yii',
    ];

    public static function init(string $provider = '', string $method = '', int $times = 1)
    {
        if (empty($provider)) {
            throw new \BadMethodCallException(
                sprintf(
                    'Incorrect benchmark run. Usage: "%s %s/run <provider> <test> <times>". Supported providers: %s',
                    PHP_BINARY,
                    DOCROOT,
                    implode(', ', self::$ormProviders)
                )
            );
        }



        $provider = __NAMESPACE__ . '\\Provider\\' . ucfirst($provider);
        $provider = new $provider();

        fprintf(STDOUT, "Start %s benchmarking...\n\n", $provider->getClass());

        $provider->run($method, $times);
    }
}
