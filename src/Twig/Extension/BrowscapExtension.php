<?php
declare(strict_types = 1);
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
        return [new \Twig_SimpleFunction('get_browser', [$this->browscap, 'getBrowser'])];
    }

    public function getName()
    {
        return 'browscap';
    }
}
