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
    public $metaDataStorage = null;
    public $build = 'N/A';

    public function putResultsToReportFile()
    {
        if ($this->callTimes != 1 && $this->callTimes != 10) {
            throw new \BadMethodCallException(
                __METHOD__ . " is designed to generate reports for tests called 1 or 10 times. " .
                "To use this reporter for tests called {$this->callTimes} times please create new a template file."
            );
        }

        $template = sprintf(
            '%s/results/templates/%s-%s%s.csv',
            DOCROOT,
            $this->method,
            $this->callTimes,
            $this->metaDataStorage ? $this->metaDataStorage : ''
        );

        if (!file_exists($template)) {
            throw new \RuntimeException("Unable to locate template reprort. The file '{$template}' doesn't exists");
        }

        if (!$contents = file_get_contents($template)) {
            throw new \RuntimeException("Unable to open template reprort file: '{$template}'");
        }

        $reportDst = sprintf('%s/results/%s/%s/%s', DOCROOT, date('Y'), date('m'), date('d'));

        if (!file_exists($reportDst) && !mkdir($reportDst, 0777, true)) {
            throw new \RuntimeException("Unable to create new report directory: '{$reportDst}'");
        }

        $contents = preg_replace(
            "#^\"{$this->provider}\".+$#m",
            sprintf('"%s","%s","%s","%s"', $this->provider, $this->elapsedTime, $this->memoryUsage, $this->totalMemoryUsage),
            $contents
        );

        $filename = sprintf('%s/%s-%s%s.csv', $reportDst, $this->method, $this->callTimes, $this->metaDataStorage ? $this->metaDataStorage : '');
        if (!file_put_contents($filename, $contents)) {
            throw new \RuntimeException("Unable to store benchmark results to the file: '{$filename}'");
        }
    }
}
