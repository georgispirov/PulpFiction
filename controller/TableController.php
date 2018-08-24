<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;
use PulpFiction\core\PulpFiction;

class TableController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
         if (isset($_GET['term'])) {
             $search = $_GET['term'];
             $sql = <<<SQL
             show tables like :q
SQL;

             $stmt = PulpFiction::$app->getDb()->query($sql);
             $result = $stmt->execute([
                 ':q' => "%$search%"
             ]);

             echo json_encode($result->fetchAllColumns());
         }
    }
}