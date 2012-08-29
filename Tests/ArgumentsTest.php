<?php
include_once('PHPUnit/Autoload.php');
require_once('Arguments.php');

class ArgumentsTest extends PHPUnit_Framework_TestCase
{
    protected $arguments = null;

    public function setUp()
    {
        $this->arguments = new \Sublime\Service\PhantomJS\Arguments();
    }

    public function tearDown()
    {
        $this->arguments = null;
    }

    public function testIsOptionsObject()
    {
        $this->assertInstanceOf('\Sublime\Service\PhantomJS\Arguments', $this->arguments, 'Is not correct instance!');
    }

    public function testToStringIsString()
    {
        $this->assertTrue(is_string((string) $this->arguments));
    }

}
