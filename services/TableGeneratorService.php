<?php

namespace PulpFiction\services;

class TableGeneratorService
{
    public function mapSQLDataTypes($type)
    {
        $dataTypes = require_once $_SERVER['DOCUMENT_ROOT'] . '/../core/Config/db_data_types.php';
        return $dataTypes[$type];
    }

    public function generateClassDependsOnTable(array $mappedFields,
                                                string $dtoName,
                                                string $nameSpace)
    {
        $file = $this->createClassFile($dtoName);
        $filePath = $this->generateAppropriateClass($file, $dtoName, $nameSpace,$mappedFields);
        chmod($filePath, 0777);
    }

    private function createClassFile(string $dtoName)
    {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . '/../model/' . "{$dtoName}.php";
        $resource = fopen($fileName, 'w+');
        return $resource;
    }

    private function generateAppropriateClass($file,
                                              string $dtoName,
                                              string $nameSpace,
                                              array $mappedFields)
    {
        $properties = $this->generateMappedClassFields($mappedFields, $dtoName);
        $content = <<<PHP
<?php

namespace $nameSpace;

class $dtoName extends \PulpFiction\core\ActiveRecord\ActiveRecord
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

    private function generateMappedClassFields(array $mappedFields, string $dtoName)
    {
        $lowerCaseDtoName = strtolower($dtoName);
        $properties = '    public static $table_name = ' . '\'' . $lowerCaseDtoName . '\'' . ';' . PHP_EOL;

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