<?php

namespace PulpFiction\core\Session;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use PulpFiction\core\InvalidAppliedConfigException;
use SessionHandler;
use SessionHandlerInterface;
use Traversable;

class Session implements SessionInterface, IteratorAggregate, ArrayAccess, Countable
{
    /**
     * @var SessionHandlerInterface $sessionHandler
     */
    private $sessionHandler;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->openSession();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return PHP_SESSION_ACTIVE === session_status();
    }

    public function openSession()
    {
        if (false !== $this->isActive()) {
            return;
        }

        $this->registerSession();

        if ( !$this->sessionHandler instanceof SessionHandlerInterface ) {
            throw new InvalidAppliedConfigException('Session handler must implement SessionHandlerInterface.');
        }

        @session_start();
    }

    /**
     * @return mixed
     */
    public function closeSession()
    {
        if ($this->isActive()) {
            $this->sessionHandler->close();
        }
    }

    /**
     * @return mixed
     */
    public function registerSession()
    {
        if (null === $this->sessionHandler) {
            $this->sessionHandler = new SessionHandler();
        }

        session_set_save_handler($this->sessionHandler, false);
    }

    /**
     * @param string $id
     */
    public function setSessionID(string $id)
    {
        session_id($id);
    }

    /**
     * @return string
     */
    public function getSessionName(): string
    {
        return session_name();
    }

    /**
     * @return string
     */
    public function getSessionSavePath(): string
    {
        return session_save_path();
    }

    /**
     * @param string $path
     * @throws InvalidAppliedConfigException
     */
    public function setSessionSavePath(string $path)
    {
        if (false === is_dir($path)) {
            throw new InvalidAppliedConfigException('Session save path must be a valid directory.');
        }

        session_save_path($path);
    }

    public function get(string $key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return null|mixed
     */
    public function remove(string $key)
    {
        if ( !isset($_SESSION[$key]) ) {
            return null;
        }

        $sessionValue = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $sessionValue;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function removeAll()
    {
        // TODO: Implement removeAll() method.
    }

    public function addFlash()
    {
        // TODO: Implement addFlash() method.
    }

    public function setFlash()
    {
        // TODO: Implement setFlash() method.
    }

    public function removeFlash()
    {
        // TODO: Implement removeFlash() method.
    }

    public function removeAllFlashes()
    {
        // TODO: Implement removeAllFlashes() method.
    }

    public function getFlash()
    {
        // TODO: Implement getFlash() method.
    }

    /**
     * @return bool
     */
    public function hasFlash(): bool
    {
        // TODO: Implement hasFlash() method.
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        $this->openSession();
        return new SessionIterator();
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($_SESSION[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        return isset($_SESSION[$offset]);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($_SESSION);
    }
}