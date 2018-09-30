<?php

namespace PulpFiction\core\EventBuilder;

class Event
{
    /**
     * @var string $_name
     */
    private $_name;

    /**
     * @var array $_params
     */
    private $_params;

    private $_sender;

    /**
     * Event constructor.
     * @param string $name
     * @param array $params
     */
    public function __construct(string $name,
                                array $params)
    {
        $this->_name = $name;
        $this->_params = $params;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }
}