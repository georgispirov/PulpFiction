<?php

namespace PulpFiction\core\App;

use PulpFiction\DatabaseConnection\DatabaseInterface;

interface ApplicationInterface
{
    /**
     * @param DatabaseInterface $database
     * @return mixed
     */
    public function getDb(DatabaseInterface $database);

    /**
     * @return mixed
     */
    public function parseUrl();
}