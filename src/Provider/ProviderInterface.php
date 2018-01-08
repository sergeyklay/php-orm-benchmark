<?php

namespace OrmBench\Provider;

interface ProviderInterface
{
    public function setUp();

    public function run(string $method, int $times);

    public function create();
    public function read(int $id);

    public function getClass(): string;
    public function isUseMetadataCaching(): bool;
}
