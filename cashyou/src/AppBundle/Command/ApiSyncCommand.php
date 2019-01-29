<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApiSyncCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:api-sync')
            ->setDescription('Save user data from API into local database.')
	        ->addArgument('username', InputArgument::OPTIONAL, 'Username')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getContainer()->get('app.turnkey.lender.api.sync_helper');
        $api = $this->getContainer()->get('app.turnkey.lender.api');

        $apiLogging = $api->getApiLogging();
		$api->setApiLogging(false);

        $username = $input->getArgument('username');

        try {
        	if ($username) {
		        $helper->syncUserData($username);

		        $output->writeln(sprintf('User \'<fg=green>%s</>\' saved successfully.', $username));
	        } else {
        		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		        $users = $em->createQuery('select u.login from AppBundle\Entity\User u')->getResult();

		        $successCount = 0;
		        $failedCount = 0;

		        if (!empty($users)) {
			        $progress = new ProgressBar($output, count($users));

			        foreach ($users as $user) {
				        $result = false;

				        try {
					        $result = $helper->syncUserData($user['login']);
				        } catch (\Exception $e) {}

				        if ($result) {
					        $successCount++;
				        } else {
					        $failedCount++;
				        }

				        $progress->advance();
			        }

			        $progress->finish();
		        }

		        $output->writeln('');
		        $output->writeln(sprintf(
		        	'<fg=green>%d</> users processed, <fg=green>%d</> success, <fg=red>%d</> failed.',
			        count($users),
			        $successCount,
			        $failedCount
		        ));
	        }
        } catch (\Exception $e) {
	        $output->writeln(sprintf('<error>Error occurred when processing %s user: %s</error>', $username, $e->getMessage()));
        }

        $api->setApiLogging($apiLogging);
    }
}