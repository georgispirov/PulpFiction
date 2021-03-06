<?php

namespace PulpFiction\DatabaseConnection;

use PDO;
use PDOStatement;
use PulpFiction\core\Model;

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

    public function fetchAllAssociative()
    {
        return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchColumn()
    {
        return $this->pdoStatement->fetchColumn();
    }

    public function fetchAllColumns()
    {
        return $this->pdoStatement->fetchAll(PDO::FETCH_COLUMN);
    }
}