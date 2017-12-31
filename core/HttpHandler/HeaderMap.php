<?php

namespace PulpFiction\core\HttpHandler;

class HeaderMap implements HeaderMapInterface
{
    /**
     * @var array $_headers
     */
    private $_headers = [];

    /**
     * @param string $name
     * @return string|null
     */
    public function get(string $name)
    {
        $name = strtolower($name);
        if (array_key_exists($name, $this->_headers)) {
            return reset($this->_headers);
        }
        return null;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function set(string $name, string $value): HeaderMap
    {
        $name = strtolower($name);
        $this->_headers[$name] = [$value];

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function add(string $name, string $value): HeaderMap
    {
        $name = strtolower($name);
        $this->_headers[$name][] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isHaving(string $name): bool
    {
        $name = strtolower($name);
        return array_key_exists($name, $this->_headers);
    }
}