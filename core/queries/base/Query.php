<?php

namespace softuni\core\queries\base;

use softuni\core\Application;
use softuni\core\Model;
use softuni\core\queries\QueryInterface;
use softuni\core\SQLBuilder\SQLBuilder;
use softuni\core\SQLBuilder\SQLBuilderInterface;
use softuni\DatabaseConnection\Database;

class Query implements QueryInterface
{
    /**
     * @var array $params
     */
    public $params = [];

    /**
     * @var string $from
     */
    protected $from;

    public function initParams(array $params): QueryInterface
    {
        if (!empty($params) && is_array($params)) {
            if (empty($this->params)) {
                $this->params = $params;
            } else {
                foreach ($params as $key => $value) {
                    if (is_numeric($key)) {
                        $this->params[] = $value;
                    } else {
                        $this->params[$key] = $value;
                    }
                }
            }
        }

        return $this;
    }

    public function prepare(Database $db): SQLBuilderInterface
    {
        return new SQLBuilder($db);
    }

    public function where(array $params = []): QueryInterface
    {
        $this->initParams($params);
        $this->from = $this->setTable(get_called_class());
        return $this;
    }

    public function setTable(string $className): string
    {
        $exploded = explode('\\', $className);
        $tableName = end($exploded);
        return strtolower(str_replace('Query', '', $tableName));
    }

    /**
     * @return boolean|Model
     */
    public function one()
    {
        return $this->prepare(Application::getDb())
                    ->queryOne($this->from, $this->params);
    }

    public function all(): array
    {
        return $this->prepare(Application::getDb())
                    ->queryAll($this->from, $this->params);
    }
}