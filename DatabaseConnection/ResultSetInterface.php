<?php

namespace softuni\DatabaseConnection;

use softuni\core\Model;

interface ResultSetInterface
{
    public function fetchAll(string $className = null): array;

    /**
     * @param string|null $className
     * @return boolean|Model
     */
    public function fetch(string $className = null);
}