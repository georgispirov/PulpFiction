<?php

namespace PulpFiction\DatabaseConnection;

interface PreparedStatementInterface
{
    public function execute(array $params = []) : ResultSetInterface;
}