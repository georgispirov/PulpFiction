<?php

namespace softuni\DatabaseConnection;

use PDOStatement;
use softuni\core\Model;

class PDOResultSet implements ResultSetInterface
{
    /**
     * @var PDOStatement
     */
    private $pdoStatement;

    public function __construct(PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }

    public function fetchAll(string $className = null): array
    {
        $objects = [];
        while ($row = $this->pdoStatement->fetchObject($className)) {
            $objects[] = $row;
        }
        return $objects;
    }

    /**
     * @param string|null $className
     * @return boolean|Model
     */
    public function fetch(string $className = null)
    {
        return $this->pdoStatement->fetchObject($className);
    }
}