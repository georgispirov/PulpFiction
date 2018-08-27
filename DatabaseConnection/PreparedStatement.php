<?php

namespace PulpFiction\DatabaseConnection;

use PDOStatement;

class PreparedStatement implements PreparedStatementInterface
{
    /**
     * @var PDOStatement
     */
    private $pdoStatement;

    /**
     * PreparedStatement constructor.
     * @param PDOStatement $pdoStatement
     */
    public function __construct(PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;

        return new PDOResultSet($this->pdoStatement);
    }

    /**
     * @param array $params
     * @return ResultSetInterface
     */
    public function execute(array $params = []): ResultSetInterface
    {
        $this->pdoStatement->execute($params);

        return new PDOResultSet($this->pdoStatement);
    }

    /**
     * @param int $column
     * @return array
     */
    public function getColumnMeta(int $column)
    {
        return $this->pdoStatement->getColumnMeta($column);
    }

    public function getColumnCount()
    {
        return $this->pdoStatement->columnCount();
    }
}