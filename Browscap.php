<?php

namespace JoshuaEstes\BrowscapBundle;

use phpbrowscap\Browscap as BaseBrowscap;

/**
 * @author Joshua Estes <Joshua.Estes@ScenicCityLabs.com>
 */
class Browscap extends BaseBrowscap
{

    /**
     * @var stdClass
     */
    private $browser;

    /**
     * @return boolean
     */
    public function isIPad()
    {
        return (bool) preg_match('/iPad/', $this->_getBrowser()->browser_name);
    }

    /**
     * @return boolean
     */
    public function isIPhone()
    {
        return (bool) preg_match('/iPhone/', $this->_getBrowser()->browser_name);
    }

    /**
     * @return boolean
     */
    public function isAndroid()
    {
        return ($this->_getBrowser()->Platform === 'Android' || $this->_getBrowser()->Browser === 'Android');
    }

    /**
     * Just a cache method
     *
     * @return stdClass
     */
    private function _getBrowser()
    {
        if (null === $this->browser) {
            $this->browser = $this->getBrowser();
        }
        return $this->browser;
    }

}
