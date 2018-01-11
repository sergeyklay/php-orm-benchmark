<?php

namespace OrmBench;

class ReportCollector
{
    public $provider = 'N/A';
    public $method = 'N/A';
    public $callTimes = 0;
    public $elapsedTime = 0;
    public $memoryUsage = 0;
    public $memoryPeak = 0;
    public $totalElapsedTime = 0;
    public $totalMemoryUsage = 0;
    public $totalMemoryPeak = 0;
    public $metaDataStorage = 'N/A';
    public $build = 'N/A';

    public function printMeasurements()
    {
        fprintf(STDOUT, "Method: % 30s\nCall times: % 26d\n", $this->reporter->method, $this->reporter->callTimes);
        fprintf(STDOUT, "Elapsed time: % 24s ms.\n", $this->reporter->elapsedTime);
        fprintf(STDOUT, "Memory usage: % 24s KiB.\n", $this->reporter->memoryUsage);
        fprintf(STDOUT, "Memory peak:  % 24s KiB.\n", $this->reporter->memoryPeak);

        $template =<<<TPL

Total elapsed time: % 18s ms.
Total memory usage: % 18s KiB.
Total memory peak:  % 18s KiB.


TPL;

        fprintf(
            STDOUT,
            $template,
            $reporter->totalElapsedTime,
            $reporter->totalMemoryUsage,
            $reporter->totalMemoryPeak
        );
    }
}
