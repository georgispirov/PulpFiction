<?php

namespace PulpFiction\DatabaseConnection;

use PDO;

class Database implements DatabaseInterface
{
    /**
     * @var null|Database
     */
    private static $instance = null;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Database constructor.
     */
    private function __construct() {}

    /**
     * @return null|Database
     */
    private static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private static function setConnection()
    {
        $database = self::getInstance();
        if (!$database->pdo instanceof PDO) {
            $dbConfig = parse_ini_file('../DatabaseConnection/dbconfig.ini');
            list($dsn, $user, $password) = array_values($dbConfig);
            $database->pdo = new PDO($dsn, $user, $password);
            $database->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $database;
    }

    public static function getConnection()
    {
        return self::setConnection();
    }

    public function getDB(): PDO
    {
        return $this->pdo;
    }

    public function query(string $query): PreparedStatementInterface
    {
        $query = $this->getDB()->prepare($query);

        return new PreparedStatement($query);
    }

    public function getLastError(): array
    {
        return $this->getDB()->errorInfo();
    }

    public function getLastID(): int
    {
        return $this->getDB()->lastInsertId();
    }
}