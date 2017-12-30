<?php

namespace PulpFiction\core\Response;

use HttpInvalidParamException;
use LogicException;
use PulpFiction\core\HttpHandler\HeaderMap;
use PulpFiction\core\HttpHandler\HeaderMapInterface;

class Response implements ResponseInterface
{
    /**
     * @var int $statusCode
     */
    private $statusCode;

    /**
     * @var HeaderMapInterface $headers
     */
    private $headers;

    /**
     * @var string $message
     */
    private $message;

    /**
     * @param int $code
     * @param null $message
     * @return ResponseInterface
     * @throws HttpInvalidParamException
     */
    public function applyStatusCode(int $code,
                                    $message = null): ResponseInterface
    {
        if (null === $code) {
            throw new LogicException('Response status code cannot be omitted.');
        }

        $this->statusCode = intval($code);
        $this->message    = $message;

        if ($this->isCodeInvalid()) {
            throw new HttpInvalidParamException('HTTP status code must be a valid: ' . $code);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return HeaderMapInterface
     */
    public function getHeaders(): HeaderMapInterface
    {
        if (null === $this->headers) {
            $this->headers = new HeaderMap();
        }

        return $this->headers;
    }

    public function sendHeaders()
    {
        if (sizeof($this->headers) > 0) {
            foreach ($this->headers as $headerName => $headerValue) {
                $name = str_replace(' ', '-', ucwords(str_replace('-', ' ', $headerName)));
                $replace = true;
                foreach ($headerValue as $value) {
                    header("$name: $value", $replace);
                    $replace = false;
                }
            }
        }

        $code = $this->getStatusCode();
        header("HTTP/1.1 {$code} {$this->message}");
    }

    /**
     * @return bool
     */
    public function isCodeInvalid(): bool
    {
        return $this->getStatusCode() < 100 || $this->getStatusCode() >= 600;
    }

    /**
     * @return bool
     */
    public function isStatusOk(): bool
    {
        return $this->getStatusCode() == 200;
    }
}