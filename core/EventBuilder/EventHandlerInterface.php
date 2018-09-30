<?php

namespace PulpFiction\core\EventBuilder;

use Closure;

interface EventHandlerInterface
{
    /**
     * @param string $event
     * @param Closure $callback
     */
    public function attach(string $event, Closure $callback);

    /**
     * @param string $event
     */
    public function detach(string $event);

    public function detachAllEvents();

    /**
     * @param string $event
     * @param array $params
     */
    public function trigger(string $event,
                            array $params = []);

    /**
     * @param string $event
     * @return bool
     */
    public function hasEvent(string $event): bool;
}