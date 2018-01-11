<?php

namespace OrmBench\Provider;

use OrmBench\ReportCollector;

/**
 * OrmBench\Provider\AbstractProvider
 *
 * @package OrmBench\Provider
 */
abstract class AbstractProvider implements ProviderInterface
{
    private $timeStart = 0;
    private $timeStop  = 0;

    private $memoryStart = 0;
    private $memoryStop  = 0;

    private $useMetadataCaching = false;

    private $availableTests = [
        'create',
        'read',
    ];

    protected $reporter;

    final public function __construct(bool $caching = false)
    {
        $this->reporter = new ReportCollector();
        $this->reporter->provider = $this->getClass();

        $this->useMetadataCaching = $caching;
        $this->setUp();
    }

    final public function getReporter(): ReportCollector
    {
        return $this->reporter;
    }

    final public function getClass(): string
    {
        return substr(static::class, strlen(__NAMESPACE__) + 1);
    }

    final public function isUseMetadataCaching(): bool
    {
        return $this->useMetadataCaching;
    }

    final public function run(string $method, int $times)
    {
        $this->timeStart   = microtime(true);
        $this->memoryStart = memory_get_usage();

        switch ($method) {
            case 'read':
                if ($times > 1000) {
                    throw new \BadMethodCallException(
                        "This test does not designed to loop over items greater than 1000 times. " .
                        "To achieve that please first amend the SQL dump. Then you have to update this check."
                    );
                }

                for ($i = 0; $i < $times; ++$i) {
                    $this->read($i + 1);
                }

                $this->timeStop   = (microtime(true) - $this->timeStart) / $times;
                $this->memoryStop = (memory_get_usage() - $this->memoryStart) / $times;
                break;
            case 'create':
                for ($i = 0; $i < $times; ++$i) {
                    $this->create();
                }

                $this->timeStop   = (microtime(true) - $this->timeStart) / $times;
                $this->memoryStop = (memory_get_usage() - $this->memoryStart) / $times;
                break;
            default:
                throw new \BadMethodCallException(
                    sprintf(
                        'Incorrect benchmark run. Usage: "%s %s/run %s <test> <times> <caching>". Supported tests: %s',
                        PHP_BINARY,
                        DOCROOT,
                        strtolower($this->getClass()),
                        implode(', ', $this->availableTests)
                    )
                );
        }

        $this->reporter->method      = $method;
        $this->reporter->callTimes   = $times;
        $this->reporter->elapsedTime = number_format($this->timeStop * 1000, 2);
        $this->reporter->memoryUsage = number_format($this->memoryStop / 1024, 2);
        $this->reporter->memoryPeak  = number_format(memory_get_peak_usage() / 1024, 2);
    }
}
