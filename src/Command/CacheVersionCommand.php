<?php
declare(strict_types = 1);
namespace Browscap\BrowscapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CacheVersionCommand extends ContainerAwareCommand
{
    protected function configure() : void
    {
        $this
            ->setName('browscap:cache_version')
            ->setDescription('Indicates the version of the cache used by Browscap');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        /* @var $bc \Browscap\BrowscapBundle\Browscap */
        $bc = $this->getContainer()->get('browscap');

        //Needed to load cache and get cache version
        $bc->getBrowser('');

        $output->writeln($bc->getSourceVersion());
    }
}
