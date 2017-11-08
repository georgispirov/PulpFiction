<?php

namespace softuni\core\queries;

use softuni\core\Model;
use softuni\DatabaseConnection\Database;

interface QueryInterface
{
    public function prepare(Database $db);

    public function setTable(string $className): string;

    /**
     * @return boolean|Model
     */
    public function one();

    public function all(): array;

    public function where(array $params = []): QueryInterface;
}