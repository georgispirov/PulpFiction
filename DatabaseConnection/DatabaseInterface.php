<?php

namespace PulpFiction\DatabaseConnection;

interface DatabaseInterface
{
    public function query(string $query): PreparedStatementInterface;

    public function getLastError();

    public function getLastID();
}