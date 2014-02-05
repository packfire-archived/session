<?php

namespace Packfire\Session;

function session_regenerate_id($delete = null)
{
    TestState::$lastCalled = 'session_regenerate_id';
    TestState::$lastCalledArgs = func_get_args();
}

function session_set_save_handler()
{
    TestState::$lastCalled = 'session_set_save_handler';
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
