<?php

namespace OrmBench;

use OrmBench\Provider\ProviderFactory;

class Bootstrap
{
    public static function init(string $provider = '', string $method = '', int $times = 1, bool $caching = false)
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
        $reporter = $provider->getReporter();

        $reporter->totalElapsedTime = number_format((microtime(true) - APP_START_TIME) * 1000, 2);
        $reporter->totalMemoryUsage = number_format(memory_get_usage() - APP_START_MEMORY / 1024, 2);
        $reporter->totalMemoryPeak = number_format(memory_get_peak_usage(true) / 1024, 2);

        if ($buildId = getenv('TRAVIS_BUILD_ID') && getenv('CI')) {
            $reporter->build = $buildId;
        }

        $reporter->printMeasurements();
    }
}
