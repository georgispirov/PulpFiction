<?php

namespace PulpFiction\DatabaseConnection;

use PDO;

interface DatabaseInterface
{
    public function query(string $query): PreparedStatementInterface;

    public function getLastError();

    public function getLastID();

    /**
     * @return PDO
     */
    public function getDb(): PDO;
}