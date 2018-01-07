<?php

namespace PulpFiction\core\Session;

use PulpFiction\core\InvalidAppliedConfigException;

interface SessionInterface
{
    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @return mixed
     */
    public function openSession();

    /**
     * @return mixed
     */
    public function closeSession();

    /**
     * @return mixed
     */
    public function registerSession();

    /**
     * @param string $id
     */
    public function setSessionID(string $id);

    /**
     * @return string
     */
    public function getSessionName(): string;

    /**
     * @return string
     */
    public function getSessionSavePath(): string;

    /**
     * @param string $path
     * @throws InvalidAppliedConfigException
     */
    public function setSessionSavePath(string $path);

    public function get(string $key);

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function remove(string $key);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    public function removeAll();

    public function addFlash();

    public function setFlash();

    public function removeFlash();

    public function removeAllFlashes();

    public function getFlash();

    /**
     * @return bool
     */
    public function hasFlash(): bool;
}