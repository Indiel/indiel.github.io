<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateExpiredLeadsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:update-expired-leads')
            ->setDescription('Update status of leads which already expired and send their postbacks into keitaro.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getContainer()->get('app.tracking.helper');

        $counts = $helper->updateExpiredLeads();

        $output->writeln(sprintf('Update expired leads: %d removed, %d rejected.', $counts['removed'], $counts['rejected']));
    }
}