<?php

namespace OrmBench\Provider;

abstract class AbstractProvider implements ProviderInterface
{
    private $timeStart = 0;
    private $timeStop  = 0;

    private $memoryStart = 0;
    private $memoryStop  = 0;

    private $measurements = [];

    final public function __construct()
    {
        $this->timeStart   = microtime(true);
        $this->memoryStart = memory_get_usage();

        $this->setUp();
    }

    final function getClass()
    {
        return substr(static::class, strlen(__NAMESPACE__) + 1);
    }

    public function setUp()
    {
    }

    final public function run(int $times)
    {
        for ($i = 0; $i < $times; ++$i) {
            $this->findOne(1);
        }

        $this->timeStop   = (microtime(true) - $this->timeStart) / $times;
        $this->memoryStop = (memory_get_usage() - $this->memoryStart) / $times;

        $this->measurements[] = [
            'method'     => 'findOne',
            'times'      => $times,
            'timeStop'   => $this->timeStop,
            'memoryStop' => $this->memoryStop,
            'memoryPeak' => memory_get_peak_usage(true),
        ];

        $this->printMeasurements();
    }

    abstract function findOne(int $id);

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
