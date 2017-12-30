<?php

namespace PulpFiction\DatabaseConnection;

use PDOStatement;

class PreparedStatement implements PreparedStatementInterface
{
    /**
     * @var PDOStatement
     */
    private $pdoStatement;

    public function __construct(PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;

        return new PDOResultSet($this->pdoStatement);
    }

    public function execute(array $params = []): ResultSetInterface
    {
        $this->pdoStatement->execute($params);

        return new PDOResultSet($this->pdoStatement);
    }
}