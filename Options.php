<?php
/**
 * Options
 *
 * \Sublime\Service\PhantomJS is a nice and neat wrapper
 * for using executing PhantomJS within PHP.
 *
 * Options is the option interface to PhantomJS.
 *
 * @author  chrsm <chrstphrmrtnz@gmail.com>
 * @link    https://github.com/chrsm/PhantomJS
 */

namespace Sublime\Service\PhantomJS;

class Options
{
    /**
     * $options
     *
     * Passes the default options to phantomjs on the command line.
     *
     * @todo   Also allow for a config.json output
     * @see    http://code.google.com/p/phantomjs/wiki/Interface#Command-line_Options
     * @access protected
     * @var    array
     */
    protected $options = ['cookies-file' => null, 'disk-cache' => 'no',
                          'ignore-ssl-errors' => 'no', 'load-images' => 'yes',
                          'local-to-remote-url-access' => 'no',
                          'max-disk-cache-size' => null, 'output-encoding' => 'utf8',
                          'proxy' => null, 'proxy-type' => null, 'script-encoding' => 'utf8',
                          'web-security' => 'yes',
                         ];

    /**
     * $compiledOptions
     *
     * Contains the last compiled options string.
     *
     * @see    PhantomJS::_compileOptions
     * @access protected
     * @var    string
     */
    protected $compiledOptions = null;

    /**
     * setCookiesFile
     *
     * Sets the cookies-file command line argument.
     *
     * @access public
     * @param  string $path The path to the cookies file.
     */
    public function setCookiesFile($path)
    {
        $this->options['cookies-file'] = $path;

        return $this;
    }

    /**
     * setCacheSize
     *
     * Sets the maxi-disk-cache-size command line argument.
     * Also sets disk-cache command line argument.
     *
     * @access public
     * @param  int    $size The maximum size the disk cache can grow to.
     */
    public function setCacheSize($size)
    {
        $this->options['disk-cache']          = 'yes';
        $this->options['max-disk-cache-size'] = $size;

        return $this;
    }

    /**
     * ignoreCertErrors
     *
     * Sets ignore-ssl-errors command line argument.
     *
     * @access public
     * @param  boolean $boolean Whether or not to ignore cert errors
     */
    public function ignoreCertErrors($boolean)
    {
        $boolean = ($boolean === true) ? 'yes' : 'no';

        $this->options['ignore-ssl-errors'] = $boolean;

        return $this;
    }

    /**
     * loadImages
     *
     * Sets the load-images command line argument.
     *
     * @access public
     * @param  boolean $boolean Whether or not to load images in PhantomJS
     */
    public function loadImages($boolean)
    {
        $boolean = ($boolean === true) ? 'yes' : 'no';

        $this->options['load-images'] = $boolean;

        return $this;
    }

    /**
     * allowRemoteURL
     *
     * Sets the local-to-remote-url-access command line argument.
     *
     * @access public
     * @param  boolean $boolean Whether or not to allow remote URLs
     */
    public function allowRemoteURL($boolean)
    {
        $boolean = ($boolean === true) ? 'yes' : 'no';

        $this->options['local-to-remote-url-access'] = $boolean;

        return $this;
    }

    /**
     * setOutputEncoding
     *
     * Sets the output-encoding command line argument.
     *
     * @access public
     * @param  string $encoding
     */
    public function setOutputEncoding($encoding)
    {
        $this->options['output-encoding'] = $encoding;

        return $this;
    }

    /**
     * setScriptEncoding
     *
     * Sets the script-encoding command line argument.
     * 
     * @access public
     * @param  string $encoding
     */
    public function setScriptEncoding($encoding)
    {
        $this->options['script-encoding'] = $encoding;

        return $this;
    }

    /**
     * webSecurity
     *
     * Sets the web-security command line argument.
     *
     * @access public
     * @param  boolean $boolean
     */
    public function webSecurity($boolean)
    {
        $boolean = ($boolean === true) ? 'yes' : 'no';

        $this->options['web-security'] = $boolean;

        return $this;
    }

    /**
     * _compileOptions
     *
     * Compiles all options into a command line string.
     * Options set to null are completely ignored.
     * 
     * @access protected
     */
    protected function _compileOptions()
    {
        $this->compiledOptions = '';

        foreach ($this->options as $name => $value) {
            if (is_null($value) ) {
                continue;
            } else {
                $this->compiledOptions .= '--' . $name . '=' . $value . ' ';
            }
        }

        $this->compiledOptions = trim($this->compiledOptions);

        return $this;
    }

    /**
     * __toString
     *
     * Compiles these options into a string.
     * 
     * @return string
     */
    public function __toString()
    {
        $this->_compileOptions();
        return $this->compiledOptions;
    }
}
