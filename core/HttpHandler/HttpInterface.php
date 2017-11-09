<?php

namespace softuni\core\HttpHandler;

interface HttpInterface
{
    public function getHeaders(): HeaderMap;

    public function isAjax(): bool;

    /**
     * @return null|string
     */
    public function getUserIP();

    public function isPostRequest(): bool;

    public function isGetRequest(): bool;
}