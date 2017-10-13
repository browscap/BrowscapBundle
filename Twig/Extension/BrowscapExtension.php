<?php
namespace Browscap\BrowscapBundle\Twig\Extension;

use phpbrowscap\Browscap;

class BrowscapExtension extends \Twig_Extension
{
    private $browscap;

    public function __construct(Browscap $browscap)
    {
        $this->browscap = $browscap;
    }

    public function getFunctions()
    {
        return array(new \Twig_SimpleFunction('get_browser', array($this->browscap, 'getBrowser')));
    }

    public function getName()
    {
        return 'browscap';
    }
}
