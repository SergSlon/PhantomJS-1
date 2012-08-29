<?php
/**
 * Arguments
 *
 * \Sublime\Service\PhantomJS is a nice and neat wrapper
 * for using executing PhantomJS within PHP.
 *
 * Arguments is the argument interface to PhantomJS.
 *
 * @author  chrsm <chrstphrmrtnz@gmail.com>
 * @link    https://github.com/chrsm/PhantomJS
 */

namespace Sublime\Service\PhantomJS;

class Arguments
{
    /**
     * $script
     *
     * The filename (or path to file) of the script PhantomJS should
     * execute.
     *
     * @access protected
     * @var    string
     */
    protected $script;

    /**
     * $arguments
     *
     * Additional arguments to pass to the script.
     *
     * @see Arguments::$script
     * @var array
     */
    protected $arguments = [];

    /**
     * __construct
     * 
     * @param  string $script    Script name or path. If just the name, it will expect it to be in the same directory.
     * @param  array  $arguments An array of arguments to pass to this script.
     * @return \Sublime\Service\PhantomJS\Arguments
     */
    public function __construct($script = null, array $arguments = array()) 
    {
        $this->script = $script;
        $this->arguments += $arguments;
    }

    /**
     * setScript
     *
     * @access public
     * @param  string $script
     * @return void
     */
    public function setScript($script)
    {
        $this->script = realpath($script);
        
        if (!$this->script) {
            throw new \RuntimeException('Specified PhantomJS script does not exist');
        }

        return $this;
    }

    /**
     * add
     *
     * Adds an argument to this Arguments object.
     *
     * @access public
     * @param  string $argument
     * @return void
     */
    public function add($argument)
    {
        $this->arguments[] = \escapeshellarg($argument);

        return $this;
    }

    /**
     * _compileArguments
     *
     * Compiles the script + arguments into a nice string.
     *
     * @access protected
     * @return void
     */
    protected function _compileArguments()
    {
        $this->compiledArguments = $this->script . ' ' . implode(' ', $this->arguments);
        $this->compiledArguments = trim($this->compiledArguments);
    }

    /**
     * __toString
     * 
     * @return string
     */
    public function __toString()
    {
        $this->_compileArguments();

        return $this->compiledArguments;
    }
}
