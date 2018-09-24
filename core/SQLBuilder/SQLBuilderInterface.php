<?php

namespace softuni\core\SQLBuilder;


interface SQLBuilderInterface
{
    public function queryOne(string $tableName = null, array $params = []);

    public function queryAll(string $tableName = null, array $params = []): array;

    public function select(string $sql): self;

    public function where(): self;

    public function buildCommand($db = null);
}