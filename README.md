# Browscap/BrowscapBundle

[![Build Status](https://travis-ci.org/browscap/BrowscapBundle.png?branch=master)](https://travis-ci.org/browscap/BrowscapBundle) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/browscap/BrowscapBundle/badges/quality-score.png?s=0a058c81e93dd25ad58b538c8578d14c8fe31ca6)](https://scrutinizer-ci.com/g/browscap/BrowscapBundle/) [![Code Coverage](https://scrutinizer-ci.com/g/browscap/BrowscapBundle/badges/coverage.png?s=6ff7ad2d6ef5cd27781edc70bc3370d06134d074)](https://scrutinizer-ci.com/g/browscap/BrowscapBundle/)

This is a service for you that is similar to the php fucntion get_browser(). It
uses https://github.com/browscap/browscap-php project.

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
        remote_ini_url:       http://browscap.org/stream?q=PHP_BrowsCapINI
        remote_ver_url:       http://browscap.org/version
        cache_dir:            null # If null, use your application cache directory
        timeout:              5
        update_interval:      432000
        error_interval:       7200
        do_auto_update:       true
        update_method:        'cURL' # Supported methods: 'URL-wrapper','socket','cURL' and 'local'.
        local_file:           null # Only if used
        cache_filename:       'cache.php'
        ini_filename:         'browscap.ini'
        lowercase:            false # You need to rebuild the cache if this option is changed
        silent:               false

## Usage

In your controller, you will just need to get the browser information via the
dependency injection container.

    // @var $browscap \Browscap\BrowscapBundle\Browscap
    $browscap = $this->container->get('browscap');
    $browser = $browscap->getBrowser();

In the future there might be some more functions.

