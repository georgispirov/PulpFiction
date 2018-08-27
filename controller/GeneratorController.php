<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;
use PulpFiction\services\TableGeneratorService;
use PulpFiction\core\PulpFiction;

class GeneratorController extends Controller
{
    /**
     * @var TableGeneratorService
     */
    private $_generatorService;

    /**
     * GeneratorController constructor.
     * @param TableGeneratorService $generatorService
     */
    public function __construct(TableGeneratorService $generatorService)
    {
        $this->_generatorService = $generatorService;
        parent::__construct();
    }

    public function generate()
    {
        $queryParams = $this->getRequest()->getQueryParams();

        if (isset($queryParams['table'])) {
            $sql = <<<SQL
            DESCRIBE {$queryParams["table"]};
SQL;

            $columnNamesStmt = PulpFiction::$app->getDb()->query($sql);
            $columns = $columnNamesStmt->execute();
            $columnNames = $columns->fetchAllColumns();

            $sqlGetColumnIndexes = <<<SQL
            select * from {$queryParams["table"]};
SQL;

            $columnTypes = [];
            $columnIndexesStmt = PulpFiction::$app->getDb()->query($sqlGetColumnIndexes);
            $columnIndexesStmt->execute();

            foreach (range(0, $columnIndexesStmt->getColumnCount() - 1) as $index) {
                $columnTypes[] = $this->_generatorService->mapSQLDataTypes($columnIndexesStmt->getColumnMeta($index)['native_type']);
            }

            $this->_generatorService
                 ->generateClassDependsOnTable(
                $queryParams['table'],
                array_combine($columnNames, $columnTypes),
                $queryParams['model-name'],
                $queryParams['namespace']
            );
        }

        return $this->render('generator/index');
    }
}