<?php
/**
 * PhantomJS
 *
 * \Sublime\Service\PhantomJS is a nice and neat wrapper
 * for using executing PhantomJS within PHP.
 *
 * PhantomJS is the main wrapper around the PhantomJS executable.
 *
 * @author  chrsm <chrstphrmrtnz@gmail.com>
 * @link    https://github.com/chrsm/PhantomJS
 */

namespace Sublime\Service\PhantomJS;

class PhantomJS 
{
    /**
     * $arguments
     *
     * Holds an instance of PhantomJS\Arguments
     *
     * @access public
     * @var \Sublime\Service\PhantomJS\Arguments
     */
    public $arguments;

    /**
     * $options
     *
     * Holds an instance of PhantomJS\Options
     * 
     * @access public
     * @var    \Sublime\Service\PhantomJS\Options
     */
    public $options;

    /**
     * $executable
     *
     * Holds the path to the phantomjs executable.
     *
     * @access protected
     * @var string
     */
    protected $executable = '/usr/local/bin/phantomjs';

    /**
     * $lastResult
     *
     * Holds the result from the last execution.
     *
     * @see PhantomJS::getLastResult
     * @access protected
     * @var string
     */
    protected $lastResult = '';

    public function __construct(Arguments &$arguments = null, Options &$options = null)
    {
        if (is_null($arguments)) {
            $arguments = new Arguments();
        }

        if (is_null($options)) {
            $options = new Options();
        }

        $this->arguments = $arguments;
        $this->options   = $options;
    }

    /**
     * execute
     *
     * Executes PhantomJS using the provided Arguments and Options.
     *
     * @access public
     */
    public function execute()
    {
        $arguments = (string) $this->arguments;
        $options   = (string) $this->options;

        $this->lastResult = shell_exec($this->executable . ' ' . $options . ' ' . $arguments);

        return $this;
    }

    /**
     * getLastResult
     *
     * Returns the last result from an execution of PhantomJS.
     * May be empty, as this depends on the output of the script executed.
     *
     * @access public
     * @return string
     */
    public function getLastResult()
    {
        return $this->lastResult;
    }
}
