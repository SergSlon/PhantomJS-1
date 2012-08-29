Sublime Service: PhantomJS
==========================

Sublime\Service\PhantomJS is a simple service wrapping "library" I am writing around PhantomJS.

I expect to release "command packs" for PhantomJS that utilize this library for use in Sublime-based
applications. Or something like that. You could just use it without all that fun stuff!



Example
===============
Example usage:

<pre>
use Sublime\Service\PhantomJS;

$phantom = new PhantomJS\PhantomJS();
$phantom->options->setCacheSize(4096)->ignoreCertErrors(true);
$phantom->arguments->setScript('/opt/phantomjs-1.6.1/examples/rasterize.js')
                   ->add('http://www.google.com/')
                   ->add('google.pdf');
$phantom->execute();
</pre>