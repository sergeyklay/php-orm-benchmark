<?php

namespace OrmBench\Provider;

interface ProviderInterface
{
    public function setUp();

    public function run(int $times);
}
