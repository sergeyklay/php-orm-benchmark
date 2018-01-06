<?php

namespace OrmBench;

class Bootstrap
{
    public static $ormProviders = [
        'phalcon'
    ];

    public static function init(string $provider)
    {
        if (empty($provider)) {
            throw new \BadMethodCallException(
                sprintf(
                    "Incorrect benchmark run. Usage: '%s %s/run <provider>'. Supported providers: %s",
                    PHP_BINARY,
                    DOCROOT,
                    implode(', ', self::$ormProviders)
                )
            );
        }

        printf("Start benchmarking ...\n\n");

        $provider = __NAMESPACE__ . '\\Provider\\' . ucfirst($provider);
        $provider = new $provider();
        $provider->run();
    }
}