<?php

namespace softuni\DatabaseConnection;

interface PreparedStatementInterface
{
    public function execute(array $params = []) : ResultSetInterface;
}