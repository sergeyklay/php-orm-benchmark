<?php

namespace OrmBench;

use OrmBench\Provider\ProviderFactory;

class Bootstrap
{
    public static function init(string $provider = '', string $method = '', int $times = 1, int $caching = 0)
    {
        if (empty($provider)) {
            throw new \BadMethodCallException(
                sprintf(
                    'Incorrect benchmark run. Usage: "%s %s/run <provider> <test> <times> <caching>". Supported providers: %s',
                    PHP_BINARY,
                    DOCROOT,
                    implode(', ', ProviderFactory::$ormProviders)
                )
            );
        }

        $provider = ProviderFactory::create($provider, $caching);

        fprintf(
            STDOUT,
            "Start %s benchmarking %s metadata caching...\n\n",
            $provider->getClass(),
            $provider->isUseMetadataCaching() ? 'with' : 'without'
        );

        $provider->run($method, $times);
    }
}
