# Browscap/BrowscapBundle

This is a service for you that is similar to the php fucntion get_browser(). It
uses https://github.com/GaretJax/phpbrowscap project.

## Installation

    php composer.phar require browscap/browscap-bundle:1.0.*

This will install the current version which is beta and is the master branch. I
don't want to say it's stable yet until I have some more tests and real world
usage under the belt, but should be good enough to use in a production site.

In your app/AppKernel.php file

    public function registerBundles()
    {
        ...
        $bundles = array(
            ...
            new Browscap\BrowscapBundle\BrowscapBundle(),
            ...
        );
        ...
    }

## Configuration

You can see the configuration values and information by running `php app/console config:dump-reference BrowscapBundle`

    browscap:
        remote_ini_url:       http://tempdownloads.browserscap.com/stream.php?BrowsCapINI
        remote_ver_url:       http://tempdownloads.browserscap.com/versions/version-date.php
        cache_dir:            null # If null, use your application cache directory
        timeout:              5
		update_interval:      432000
		error_interval:       7200
		do_auto_update:       true
		update_method:        'cURL' # Supported methods: 'URL-wrapper','socket','cURL' and 'local'.

## Usage

In your controller, you will just need to get the browser information via the
dependency injection container.

    // @var $browscap \Browscap\BrowscapBundle\Browscap
    $browscap = $this->container->get('browscap');
    $browser = $browscap->getBrowser();

In the future there might be some more functions.
    
