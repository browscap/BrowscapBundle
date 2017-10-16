<?php
declare(strict_types = 1);
namespace Browscap\BrowscapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends ContainerAwareCommand
{
    protected function configure() : void
    {
        $this
            ->setName('browscap:update')
            ->setDescription('Update Browscap cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        if ($this->getContainer()->get('browscap')->updateCache()) {
            $output->writeln('The cache has been updated successfully');

            return;
        }

        $output->writeln('An error occurred during cache update');
    }
}
