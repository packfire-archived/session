<?php

namespace Packfire\Session;

use Packfire\Session\Storage;
use Packfire\FuelBlade\Container;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        TestState::reset();
    }

    public function testId()
    {
        $obj = new Storage();
        $this->assertEquals('default', $obj->id());
    }

    public function testGet()
    {
        $obj = new Storage();
        $this->assertNull($obj->get('NULL_KEY'));
        $this->assertEquals(10, $obj->get('NULL_KEY', 10));
    }

    public function testSetHas()
    {
        $obj = new Storage();
        $this->assertNull($obj->get('NULL_KEY'));
        $obj->set('NULL_KEY', 10);
        $this->assertEquals(10, $obj->get('NULL_KEY'));
        $this->assertTrue($obj->has('NULL_KEY'));
    }

    public function testRemove()
    {
        $obj = new Storage();
        $obj->set('key', true);
        $this->assertTrue($obj->get('key'));
        $obj->remove('key');
        $this->assertNull($obj->get('key'));
    }

    public function testClear()
    {
        $obj = new Storage();
        $obj->set('key', true);
        $obj->clear();
        $this->assertNull($obj->get('key'));
    }

    public function testRegenerate()
    {
        $this->assertNull(TestState::$lastCalled);

        $obj = new Storage();
        $obj->regenerate(true);
        $this->assertEquals('session_regenerate_id', TestState::$lastCalled);
        $this->assertEquals(true, TestState::$lastCalledArgs[0]);
    }
}
