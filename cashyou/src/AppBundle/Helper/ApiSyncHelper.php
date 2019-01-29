<?php

namespace AppBundle\Helper;

use AppBundle\Security\User\ApiUser;
use Doctrine\Common\Cache\CacheProvider;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Entity\User;

class ApiSyncHelper {

	/**
	 * @var EntityManager
	 */
	private $em;

	/**
	 * @var TokenStorage
	 */
	private $tokenStorage;

	/**
	 * @var TurnkeyLenderApi
	 */
	private $api;

	/**
	 * @var CacheProvider
	 */
	private $userProvider;

	/**
	 * @var string
	 */
	private $secret;

	/**
	 * ApiSyncHelper constructor.
	 *
	 * @param EntityManager $entityManager
	 * @param TokenStorage $tokenStorage
	 * @param TurnkeyLenderApi $api
	 * @param UserProviderInterface $userProvider
	 * @param string $secret
	 */
	public function __construct(EntityManager $entityManager,
		TokenStorage $tokenStorage,
		TurnkeyLenderApi $api,
		UserProviderInterface $userProvider,
		$secret) {

		$this->em           = $entityManager;
		$this->tokenStorage = $tokenStorage;
		$this->api          = $api;
		$this->userProvider = $userProvider;
		$this->secret       = $secret;
	}

	/**
	 * @param string $username
	 * @return bool
	 */
	public function syncUserData($username)
	{
		try {
			//find user token in cache
			/** @var ApiUser $apiUser */
			$apiUser = $this->userProvider->loadUserByUsername($username);

			$this->api->setToken($apiUser->getApiToken());


			if ($user = $this->api->getCustomerDetails()) {
				//add information missing in API
				$user->setLogin($username);
				$user->setApiToken($apiUser->getApiToken());

				// need save registration current step
				$userExisted = $this->em->getRepository(User::class)->findOneBy(['login' => $username]);
				$currentStepId = null;
				if($userExisted){
					$currentStepId = $userExisted->getCurrentStep();
					//echo '<pre>+++'; print_r($currentStepId); die;
				}				

				//remove previous db entry if exists
				$this
					->em
					->createQuery('delete from AppBundle\Entity\User u where u.login = :login')
					->setParameter('login', $username)
					->execute();

				//save user data taken from API
				// add current step
				$user->setCurrentStep($currentStepId);	
				$this->em->persist($user);
				$this->em->flush();

				//save user loans taken from API
				$loans = $this->api->getCustomerLoans();
				foreach ($loans as $loan) {
					foreach ($loan->getSchedule() as $scheduleRow) {
						$scheduleRow->setLoan($loan);
					}
					foreach ($loan->getRepayments() as $repaymentRow) {
						$repaymentRow->setLoan($loan);
					}
					foreach ($loan->getDocumentsToSign() as $documentToSign) {
						$documentToSign->setLoan($loan);
					}
					$loan->setUser($user);
					$this->em->persist($loan);
				}

				$this->em->flush();

				return true;
			}
		}
		catch (\Exception $e) {}
		finally {
			$this->api->setToken(null);
		}

		return false;
	}
}