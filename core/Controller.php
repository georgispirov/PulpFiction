<?php

namespace softuni\core;

abstract class Controller
{
    protected function findModel(string $modelClass): Model
    {
        $fullName = '\\softuni\\model\\' . $modelClass;
        if (class_exists($fullName)) {
            return new $fullName();
        }
    }

    protected function render(string $view, array $data = [])
    {
        require_once '../view' . DIRECTORY_SEPARATOR . $view . '.php';
        return $this;
    }

    protected function inPost(string $keys, array $post): bool
    {
        if (strpos('|', $keys) === false) {
            $this->oneKeyInPost($keys, $post);
        }

        $exploded = explode('|', $keys);
        if (is_array($exploded) && is_array($post)) {
            foreach ($exploded as $key) {
                if (array_key_exists($key, $post)) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    private function oneKeyInPost(string $key, array $post) : bool
    {
        if (array_key_exists($key, $post)) {
            return true;
        }
        return false;
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
        return [];
    }

    protected function redirect(string $route)
    {
        header("Location: ../$route");
        ob_get_clean();
        return $this;
    }
}