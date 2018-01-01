<?php

namespace PulpFiction\core\HttpHandler;

interface HeaderMapInterface
{
    public function add(string $name, string $value): HeaderMap;

    public function set(string $name, string $value): HeaderMap;

    public function get(string $name);

    public function getHeaders(): array;
}