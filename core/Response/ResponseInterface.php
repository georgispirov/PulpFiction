<?php

namespace PulpFiction\core\Response;

use PulpFiction\core\HttpHandler\HeaderMapInterface;

interface ResponseInterface
{
    /**
     * @param int $code
     * @param null $message
     * @return ResponseInterface
     */
    public function applyStatusCode(int $code,
                                    $message = null): ResponseInterface;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return HeaderMapInterface
     */
    public function getHeaderMap(): HeaderMapInterface;

    /**
     * @return mixed
     */
    public function sendHeaders();

    /**
     * @return bool
     */
    public function isCodeInvalid(): bool;

    /**
     * @return bool
     */
    public function isStatusOk(): bool;
}