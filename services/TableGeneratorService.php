<?php

namespace PulpFiction\services;

class TableGeneratorService
{
    public function mapSQLDataTypes($type)
    {
        $dataTypes = require_once $_SERVER['DOCUMENT_ROOT'] . '/../core/Config/db_data_types.php';
        return $dataTypes[$type];
    }

    public function generateClassDependsOnTable(string $tableName,
                                                array $mappedFields,
                                                string $dtoName,
                                                string $nameSpace)
    {
        $tableName = $this->beautifyClassName($tableName);
        $file = $this->createClassFile($tableName);
        $filePath = $this->generateAppropriateClass($file, $dtoName, $nameSpace,$mappedFields);
        exec("sudo chmod 775 $filePath");
    }

    private function beautifyClassName(string $tableName)
    {
        return ucfirst($tableName);
    }

    private function createClassFile(string $tableName)
    {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . '/../model/' . "{$tableName}.php";
        $resource = fopen($fileName, 'w+');
        return $resource;
    }

    private function generateAppropriateClass($file,
                                              string $dtoName,
                                              string $nameSpace,
                                              array $mappedFields)
    {
        $properties = $this->generateMappedClassFields($mappedFields);
        $content = <<<PHP
<?php

namespace $nameSpace;

class $dtoName 
{
$properties
} 
?>
PHP;

        $filePath = stream_get_meta_data($file)['uri'];
        if (0 === filesize($filePath)) { // write content to file only when its empty
            fwrite($file, $content);
        }

        fclose($file);
        return $filePath;
    }

    private function generateMappedClassFields(array $mappedFields)
    {
        $properties = '';
        foreach ($mappedFields as $field => $type) {
            $properties .= '
    /**
    * @var ' . $type . ' $' . $field . ' 
    */
    public $' . $field . ';';

            $properties .= PHP_EOL;
        }

        return $properties;
    }
}