<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Loan;
use AppBundle\Entity\RolloverAgreement;
use AppBundle\Security\User\ApiUser;
use Doctrine\ORM\EntityRepository;

class RolloverAgreementRepository  extends EntityRepository {
	public function nextAgreementId(Loan $loan)
	{
		$countRepayments = $this->createQueryBuilder('a')
		                        ->andWhere('a.loan.id = :loanId')
		                        ->setParameter('loanId', $loan->getId())
		                        ->select('count(a.id) as c')
		                        ->getQuery()
								->getSingleScalarResult();

		return $loan->getPublicId() . '-' . ($countRepayments ? $countRepayments + 1 : 1);
	}

	/**
	 * @param ApiUser $user
	 * @param Loan[] $loans
	 *
	 * @return array
	 */
	public function getAgreementDocIdsForLoans(ApiUser $user, $loans)
	{
		$loanIds = array_map(function (Loan $loan){
			return $loan->getId();
		}, $loans);

		$agreementIds = [];
		foreach ($loanIds as $loanId) {
			$agreementIds[$loanId] = [];
		}

		/** @var RolloverAgreement[] $agreements */
		$agreements = $this->findBy([
			'loan.id' => $loanIds,
			'user.login' => $user->getUsername(),
		]);

		foreach ($agreements as $agreement) {
			$agreementIds[$agreement->getLoan()->getId()][] = $agreement->getDocumentId();
		}

		return $agreementIds;
	}
}