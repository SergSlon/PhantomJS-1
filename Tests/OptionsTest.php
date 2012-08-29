<?php
include_once('PHPUnit/Autoload.php');
require_once('Options.php');

class OptionsTest extends PHPUnit_Framework_TestCase
{
    protected $options = null;

    public function setUp()
    {
        $this->options = new \Sublime\Service\PhantomJS\Options();
    }

    public function tearDown()
    {
        $this->options = null;
    }

    public function testIsOptionsObject()
    {
        $this->assertInstanceOf('\Sublime\Service\PhantomJS\Options', $this->options, 'Is not correct instance!');
    }

    public function testToStringIsString()
    {
        $this->assertTrue(is_string((string) $this->options));
    }

    public function testCompilationWorks()
    {
        // change some settings and see if we get the output we expect
        $this->options->setCacheSize(2048)->ignoreCertErrors(true);

        $string = (string) $this->options;

        $this->assertSame('--disk-cache=yes --ignore-ssl-errors=yes --load-images=yes --local-to-remote-url-access=no '.
                          '--max-disk-cache-size=2048 --output-encoding=utf8 --script-encoding=utf8 --web-security=yes',
                          $string,
                          'Is not correct string!');
    }

    public function testDoesNotHaveNullElement()
    {
        $this->options->setCookiesFile(null);

        $string = (string) $this->options;

        $this->assertFalse(strstr($string, '--cookies-file='), 'Contains a --cookies-file even when set to null!');
    }

}