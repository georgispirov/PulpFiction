<?php

namespace PulpFiction\core\HttpHandler;

interface HttpInterface
{
    /**
     * @return HeaderMapInterface
     */
    public function getRequestHeaders(): HeaderMapInterface;

    /**
     * @return bool
     */
    public function isAjax(): bool;

    /**
     * @return null|string
     */
    public function getUserIP();

    /**
     * @return bool
     */
    public function isPostRequest(): bool;

    /**
     * @return bool
     */
    public function isGetRequest(): bool;

    /**
     * @return bool
     */
    public function isPostAjaxRequest(): bool;

    /**
     * @return string
     */
    public function getQueryString(): string;

    /**
     * @return null|string
     */
    public function getReferrer();

    /**
     * @return null|string
     */
    public function getServerName();

    /**
     * @return string
     */
    public function getContentType(): string;
}