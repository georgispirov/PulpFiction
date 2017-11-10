<?php

namespace softuni\core\SQLBuilder;

use softuni\core\Model;
use softuni\DatabaseConnection\Database;
use softuni\DatabaseConnection\DatabaseInterface;

class SQLBuilder implements SQLBuilderInterface
{
    /**
     * @var Database
     */
    private $db;

    /**
     * @return null|Database
     */
    public function getDb()
    {
        if ($this->db instanceof Database) {
            return $this->db;
        }
        return null;
    }

    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
    }

    public function build(string $sql = null): \Generator {}

    /**
     * @param string|null $tableName
     * @param array $params
     * @return boolean|Model
     */
    public function queryOne(string $tableName = null, array $params = [])
    {
        $appended =  $this->translateToWhereClause($params);
        $model    =  $this->getDb()->query("SELECT * FROM $tableName WHERE $appended;")
                                   ->execute()
                                   ->fetch(ucfirst('\\softuni\\model\\' . $tableName));

        if (!$model instanceof Model) {
            return false;
        }
        return $model;
    }

    public function queryAll(string $tableName = null, array $params = []): array
    {
        $appended = '1=1';
        if (!empty($params)) {
            $appended =  $this->translateToWhereClause($params);
        }
        $models    = $this->getDb()->query("SELECT * FROM $tableName WHERE $appended;")
                                   ->execute()
                                   ->fetchAll(ucfirst('\\softuni\\model\\' . $tableName));

        if (sizeof($models) < 1) {
            return [];
        }
        return $models;
    }

    private function getParamsKeys(array $params): array
    {
        $keys = array_keys($params);
        $imploded = implode(' and ', $keys);
        return explode(' ', $imploded);
    }

    private function getParamsValues(array $params): array
    {
        return array_values($params);
    }

    private function translateToWhereClause(array $params): string
    {
        $appended = $this->getParamsKeys($params);
        $values   = $this->getParamsValues($params);
        for ($i = 0; $i < sizeof($appended); $i += 2) {
            if ($i == 0) {
                if (!is_numeric($values[$i])) {
                    $appended[$i] .= ' LIKE' . " '%". $values[$i] . "%'";
                    continue;
                }
                $appended[$i] .= ' = ' . $values[$i];
            }
            if (array_key_exists($i - 1, $values)) {
                if (!is_numeric($values[$i - 1])) {
                    $appended[$i] .= ' LIKE' . " '%". $values[$i-1] . "%'";
                    continue;
                }
                $appended[$i] .= ' = ' . $values[$i - 1];
            }
        }
        return implode(' ', $appended);
    }
}