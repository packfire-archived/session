<?php

namespace Packfire\Session\Storage;

function session_regenerate_id($delete = null)
{
    TestState::$lastCalled = 'session_regenerate_id';
    TestState::$lastCalledArgs = func_get_args();
}

class TestState
{
    public static $lastCalled;
    public static $lastCalledArgs;

    public static function reset()
    {
        self::$lastCalled = null;
        self::$lastCalledArgs = null;
    }
}
