<?php

namespace PulpFiction\core\EventBuilder;

use Closure;

class EventHandler implements EventHandlerInterface
{
    /**
     * @var array $_events
     */
    private $_events = [];

    /**
     * @param string $event
     * @param Closure $callback
     */
    public function attach(string $event,
                           Closure $callback)
    {
        if (!isset($this->_events[$event])) {
            $this->_events[$event] = [];
        }

        $this->_events[$event][] = $callback;
    }

    /**
     * @param string $event
     */
    public function detach(string $event)
    {
        if (isset($this->_events[$event])) {
            unset($this->_events[$event]);
        }
    }

    /**
     * @param string $event
     * @param array $params
     */
    public function trigger(string $event,
                            array $params = [])
    {
        foreach ($this->_events[$event] as $event => $callback) {
            $e = new Event($event, $params);
            $callback($e);
        }
    }

    public function detachAllEvents()
    {
        $this->_events = [];
    }

    /**
     * @param string $event
     * @return bool
     */
    public function hasEvent(string $event): bool
    {
        return array_key_exists($event, $this->_events);
    }
}