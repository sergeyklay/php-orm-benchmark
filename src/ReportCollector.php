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

    public function getPublicReport()
    {
        return [
            $this->provider,
            $this->elapsedTime,
            $this->memoryUsage,
            $this->totalMemoryUsage,
            $this->method,
            $this->build,
        ];
    }

    public function getPublicReportUsingMetadataCaching()
    {
        return [
            $provider,
            $this->elapsedTime,
            $this->memoryUsage,
            $this->totalMemoryUsage,
            $this->metaDataStorage,
            $this->build,
        ];
    }
}
