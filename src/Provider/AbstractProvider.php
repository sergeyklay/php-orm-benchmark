<?php

namespace OrmBench\Provider;

abstract class AbstractProvider implements ProviderInterface
{
    private $timeStart = 0;
    private $timeStop  = 0;

    private $memoryStart = 0;
    private $memoryStop  = 0;

    final public function __construct()
    {
        $this->timeStart = microtime(true);
        $this->memoryStart = memory_get_usage();
  
        $this->setUp();
    }

    public function setUp()
    {
    }

    final public function run()
    {
        $this->findOne(1);

        $this->timeStop = microtime(true) - $this->timeStart;
        $this->memoryStop = memory_get_usage() - $this->memoryStart;

        $this->printMeasurements();
    }

    abstract function findOne(int $id);

    private function printMeasurements()
    {
        $template =<<<TPL
ORM: %s
────────────────────────────────────────

Execution time: % 8.2f MSec.
Used memory:    % 8.2f KiB.
────────────────────────────────────────

TPL;

        fprintf(
            STDOUT,
            $template,
            substr(static::class, strlen(__NAMESPACE__) + 1),
            number_format($this->timeStop * 1000, 2),
            number_format($this->memoryStop / 1024, 2)
        );
    }
}
