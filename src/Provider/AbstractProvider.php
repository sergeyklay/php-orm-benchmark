<?php

namespace OrmBench\Provider;

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

    private $measurements = [];

    private $useMetadataCaching = false;

    private $availableTests = [
        'create',
        'read',
    ];

    // TODO: for tests to delete rows
    protected $removePKs = [];

    final public function __construct(bool $caching = false)
    {
        $this->useMetadataCaching = $caching;

        $this->timeStart   = microtime(true);
        $this->memoryStart = memory_get_usage();

        $this->setUp();
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

        $this->measurements[] = [
            'method'     => $method,
            'times'      => $times,
            'timeStop'   => $this->timeStop,
            'memoryStop' => $this->memoryStop,
            'memoryPeak' => memory_get_peak_usage(),
        ];

        $this->printMeasurements();
    }

    private function printMeasurements()
    {
        foreach ($this->measurements as $test) {
            fprintf(STDOUT, "Method: % 30s\nCall times: % 26d\n", $test['method'], $test['times']);
            fprintf(STDOUT, "Elapsed time: % 24s ms.\n", number_format($test['timeStop'] * 1000, 2));
            fprintf(STDOUT, "Memory usage: % 24s KiB.\n", number_format($test['memoryStop'] / 1024, 2));
            fprintf(STDOUT, "Memory peak:  % 24s KiB.\n", number_format($test['memoryPeak'] / 1024, 2));
        }
    }
}
