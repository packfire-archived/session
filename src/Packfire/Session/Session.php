<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 *
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\Session;

/**
 * Session service implementation
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Session
 * @since 1.0-sofia
 */
class Session implements SessionInterface
{
    /**
     * Session Storage
     * @var Packfire\Session\StorageInterface
     * @since 1.0-sofia
     */
    private $storage;

    /**
     * Create a new Session object
     * @param Packfire\Session\StorageInterface $storage The session storage object
     * @since 1.0-sofia
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->storage->load($_SESSION);
    }

    /**
     * Get the value in the session by key
     * @param  string $key The key of the value to fetch
     * @return mixed  Returns the value
     * @since 1.0-sofia
     */
    public function get($key)
    {
        return $this->storage->get($key);
    }

    /**
     * Set a key and value to the session
     * @param string $key   The key that uniquely identify the value
     * @param mixed  $value The value
     * @since 1.0-sofia
     */
    public function set($key, $value)
    {
        $this->storage->set($key, $value);
    }

    /**
     * Clear the session of all the values
     * @since 1.0-sofia
     */
    public function clear()
    {
        $this->storage->clear();
    }

    /**
     * Invalidate the session
     * @since 1.0-sofia
     */
    public function invalidate()
    {
        $this->storage->clear();
        $this->storage->regenerate(true);
    }

    /**
     * Regenerate a new Session ID
     * @since 1.0-sofia
     */
    public function regenerate()
    {
        $this->storage->regenerate();
    }

    /**
     * Fetch a session bucket
     * @param  string        $name Name of the bucket to fetch
     * @return SessionBucket Returns the bucket
     * @since 1.0-sofia
     */
    public function bucket($name)
    {
        $bucket = $this->storage->bucket($name);
        if (!$bucket) {
            $bucket = new Bucket($name);
            $bucket->load($_SESSION[$name]);
            $this->storage->register($bucket);
        }

        return $bucket;
    }

    /**
     * Check if the session cookie is set.
     * @return boolean Returns true if the cookie is set, false otherwise.
     * @static
     * @since 2.1.0
     */
    public static function detectCookie()
    {
        return !(!isset($_COOKIE[session_name()]) || !$_COOKIE[session_name()]);
    }

    /**
     * Register the session
     * @since 2.1.0
     */
    public function register()
    {
        if (!self::detectCookie()) {
            session_start();
        }
    }

    /**
     * Unregister the session
     * @since 2.1.0
     */
    public function unregister()
    {
         session_destroy();
         setcookie(session_name(), '', -1);
    }
}
