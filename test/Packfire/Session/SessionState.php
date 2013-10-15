<?php

namespace Packfire\Session;

function session_start()
{
    SessionState::start();
}

function session_name()
{
    return 'phpunit_test';
}

function session_destroy()
{
    SessionState::stop();
}

function setcookie()
{
    SessionState::setCookie(func_get_args());
}

class SessionState
{
    protected static $started = false;

    protected static $cookie = null;

    public static function start()
    {
        self::$started = true;
        self::$cookie = true;
    }

    public static function stop()
    {
        self::$started = false;
    }

    public static function queryStart()
    {
        return self::$started;
    }

    public static function setCookie($data)
    {
        self::$cookie = $data;
    }

    public static function getCookie()
    {
        return self::$cookie;
    }

    public static function reset()
    {
        self::$started = false;
        self::$cookie = false;
    }
}
