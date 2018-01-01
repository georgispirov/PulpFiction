<?php

namespace PulpFiction\core\HttpHandler;

class Request extends HeaderMap implements HttpInterface
{
    /**
     * @var HeaderMap
     */
    private $_headerMap;

    /**
     * @return HeaderMapInterface
     */
    public function getRequestHeaders(): HeaderMapInterface
    {
        if (!$this->_headerMap instanceof HeaderMap) {
            $this->_headerMap =  new parent();
            foreach (getallheaders() as $name => $value) {
                $this->_headerMap->add($name, $value);
            }
        }
        return $this->_headerMap;
    }

    /** Check if the [[Request]] is AJAX
     * @return bool
     */
    public function isAjax(): bool
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /** Get User IP
     * @return null|string
     */
    public function getUserIP()
    {
        return isset($_SERVER['REMOTE_ADDR']) ?? null;
    }

    /** Return true if the [[Request]] is by POST Method
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /** Return true if the [[Request]] is by GET Method
     * @return bool
     */
    public function isGetRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPostAjaxRequest(): bool
    {
        return ($this->isPostRequest() && $this->isAjax());
    }

    /**
     * @return string
     */
    public function getQueryString(): string
    {
        return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
    }

    public function getReferrer()
    {
        return $this->_headerMap->get('Referer');
    }

    /**
     * @return null|string
     */
    public function getServerName()
    {
        return ($_SERVER['SERVER_NAME']) ?? null;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return ($_SERVER['CONTENT_TYPE']) ?? $this->_headerMap->get('Content-Type');
    }
}