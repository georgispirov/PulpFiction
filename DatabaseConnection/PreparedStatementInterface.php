<?php

namespace PulpFiction\DatabaseConnection;

interface PreparedStatementInterface
{
    /**
     * @param array $params
     * @return ResultSetInterface
     */
    public function execute(array $params = []) : ResultSetInterface;

    /**
     * @param int $column
     */
    public function getColumnMeta(int $column);

    public function getColumnCount();
}