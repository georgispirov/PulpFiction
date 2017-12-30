<?php

namespace softuni\core\SQLBuilder;


interface SQLBuilderInterface
{
    public function build(string $sql = null): \Generator;

    public function queryOne(string $tableName = null, array $params = []);

    public function queryAll(string $tableName = null, array $params = []): array;
}