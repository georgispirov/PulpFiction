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
     * @var HeaderMapInterface|null $headers
     */
    private $headerMap;

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
    public function getHeaderMap(): HeaderMapInterface
    {
        if (null === $this->headerMap) {
            $this->headerMap = new HeaderMap();
        }

        return $this->headerMap;
    }

    public function sendHeaders()
    {
        if ($this->getHeaderMap()->getHeaders()) {
            foreach ($this->getHeaderMap()->getHeaders() as $headerName => $headerValue) {
                foreach ($headerValue as $value) {
                    header("$headerName: $value");
                }
            }
        }
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