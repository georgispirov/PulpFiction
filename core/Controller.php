<?php

namespace softuni\core;

use PDO;

abstract class Controller
{
    protected $db = null;

    public function __construct(PDO $db)
    {
        $this->setDB($db);
    }

    protected function setDB(PDO $db)
    {
        if ($db instanceof PDO) {
            $this->db = $db;
        }
    }

    protected function getDB() : PDO
    {
        if ($this->db instanceof PDO) {
            return $this->db;
        }
    }

    protected function findModel(string $modelClass) : Model
    {
        $fullName = '\\softuni\\model\\' . $modelClass;
        if (class_exists($fullName)) {
            return new $fullName($this->getDB());
        }
    }

    protected function render(string $view, array $data = [])
    {
        require_once '../view' . DIRECTORY_SEPARATOR . $view . '.php';
        return $this;
    }

    protected function inPost(string $keys, array $post) : bool
    {
        if (strpos('|', $keys) === false) {
            return $this->oneKeyInPost($keys, $post);
        }

        $exploded = explode('|', $keys);
        if (is_array($exploded) && is_array($post)) {
            foreach ($exploded as $value) {
                if (array_key_exists($value, $post) && $post[$value] !== '') {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    private function oneKeyInPost(string $key, array $post) : bool
    {
        if (array_key_exists($key, $post)) {
            return true;
        }
        return false;
    }

    protected function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    protected function getPostDataFromForm(string $postData)
    {
        $data = [];
        if (is_string($postData) && $postData !== null) {
            $exploded = explode('&', $postData);
            foreach ($exploded as $post) {
                $data [] = substr($post, strpos($post, '=') + 1);
            }
            return $data;
        }
        return false;
    }

    protected function redirect(string $route)
    {
        header("Location: ../$route");
        ob_get_clean();
        return $this;
    }

    abstract public function main();
}