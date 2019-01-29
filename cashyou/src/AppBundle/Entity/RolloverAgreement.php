<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolloverAgreementRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="rollover_agreements")
 */
class RolloverAgreement {
	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=512, nullable=true, unique=true)
	 */
	private $documentId;

	/**
	 * @var RolloverUser
	 * @ORM\Embedded(class="RolloverUser", columnPrefix="user_")
	 */
	private $user;

	/**
	 * @var Address
	 * @ORM\Embedded(class="Address", columnPrefix="user_address_")
	 */
	private $userAddress;

	/**
	 * @var Address
	 * @ORM\Embedded(class="Address", columnPrefix="user_second_address_")
	 */
	private $userSecondAddress;

	/**
	 * @var RolloverLoan
	 * @ORM\Embedded(class="RolloverLoan", columnPrefix="loan_")
	 */
	private $loan;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	private $termDays;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expiredDays;

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	private $pdfTemplate;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $created;

	/**
	 * @param string $documentId
	 * @param User $user
	 * @param Loan $loan
	 * @param int $termDays
     * @param int $expiredDays
	 * @param string $pdfTemplate
	 */
	public function __construct($documentId, User $user, Loan $loan, $termDays, $expiredDays, $pdfTemplate) {
		$this->documentId = $documentId;
		$this->user = new RolloverUser($user);
		$this->userAddress = $user->getAddress();
		$this->userSecondAddress = $user->getSecondAddress();
		$this->loan = new RolloverLoan($loan);
		$this->termDays = $termDays;
        $this->expiredDays = $expiredDays;
		$this->pdfTemplate = $pdfTemplate;
		$this->created = new \DateTime();
	}

	/**
	 * @ORM\PostLoad
	 */
	public function onPostLoad()
	{
		if ($this->userAddress) {
			$this->user->setAddress($this->userAddress);
		}

		if ($this->userSecondAddress) {
			$this->user->setSecondAddress($this->userSecondAddress);
		}
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getDocumentId() {
		return $this->documentId;
	}

	/**
	 * @return RolloverUser
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @return RolloverLoan
	 */
	public function getLoan() {
		return $this->loan;
	}

	/**
	 * @return int
	 */
	public function getTermDays() {
		return $this->termDays;
	}

    /**
     * @return int
     */
    public function getExpiredDays() {
        return $this->expiredDays;
    }

	/**
	 * @return string
	 */
	public function getPdfTemplate() {
		return $this->pdfTemplate;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}
}