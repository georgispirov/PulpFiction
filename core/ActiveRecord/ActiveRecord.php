<?php

namespace PulpFiction\core\ActiveRecord;

use ActiveRecord\Model;
use Generator;
use PDOStatement;

abstract class ActiveRecord extends Model
{
    /**
     * @param string $sql
     * @param null $values
     * @return PDOStatement
     */
    public static function query($sql, $values = null): PDOStatement
    {
        return parent::query($sql, $values);
    }

    public function asArray(array $options = [])
    {
        return $this->to_array($options);
    }

    /**
     * @return Generator
     */
    public static function findAllByGenerator(): Generator
    {
        /* @var ActiveRecord $model */
        foreach (self::find('all') as $model) {
            yield $model->asArray();
        }
    }

    /**
     * @return array
     */
    public static function findAllAsArray(): array
    {
        $models = [];

        /* @var ActiveRecord $model */
        foreach (self::find('all') as $model) {
            $models[] = $model->asArray();
        }

        return $models;
    }
}