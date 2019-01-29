<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Embeddable
 */
class RolloverLoan {
	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=1000)
	 */
	protected $publicId;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	protected $status;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	protected $nextPaymentDate;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $term;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=20, nullable=true)
	 */
	protected $loanPeriodKind;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $amount;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $interestRate;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	protected $creationDate;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $isActive;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $isClosed;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $appliedRollovers;

	/**
	 * @var boolean
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $rolloversEnabled;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $minRolloverTerm;

	/**
	 * @var RolloverUnit
	 * @ORM\Column(type="rollover_unit", nullable=true)
	 */
	protected $minRolloverUnit;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $maxRolloverTerm;

	/**
	 * @var RolloverUnit
	 * @ORM\Column(type="rollover_unit", nullable=true)
	 */
	protected $maxRolloverUnit;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $maxRollovers;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $outstandingBalancePrincipal;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $outstandingBalanceInterest;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $expectedPaymentAmount;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=1000, nullable=true)
	 */
	protected $creditProductId;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=1000, nullable=true)
	 */
	protected $creditProductName;

    /**
     * @var ArrayCollection|ScheduleRow[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ScheduleRow", mappedBy="loan", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $schedule;

	public function __construct(Loan $loan) {
		$this->id = $loan->getId();
		$this->publicId = $loan->getPublicId();
		$this->status = $loan->getStatus();
		$this->nextPaymentDate = $loan->getNextPaymentDate();
		$this->term = $loan->getTerm();
		$this->loanPeriodKind = $loan->getLoanPeriodKind();
		$this->amount = $loan->getAmount();
		$this->interestRate = $loan->getInterestRate();
		$this->creationDate = $loan->getCreationDate();
		$this->isActive = $loan->isActive();
		$this->isClosed = $loan->isClosed();
		$this->appliedRollovers = $loan->getAppliedRollovers();
		$this->rolloversEnabled = $loan->isRolloversEnabled();
		$this->minRolloverTerm = $loan->getMinRolloverTerm();
		$this->minRolloverUnit = $loan->getMinRolloverUnit();
		$this->maxRolloverTerm = $loan->getMaxRolloverTerm();
		$this->maxRolloverUnit = $loan->getMaxRolloverUnit();
		$this->maxRollovers = $loan->getMaxRollovers();
		$this->outstandingBalancePrincipal = $loan->getOutstandingBalancePrincipal();
		$this->outstandingBalanceInterest = $loan->getOutstandingBalanceInterest();
		$this->expectedPaymentAmount = $loan->getExpectedPaymentAmount();
		$this->creditProductId = $loan->getCreditProductId();
		$this->creditProductName = $loan->getCreditProductName();
		$this->schedule = $loan->getSchedule();
	}

	/**
	 * @return int
	 */

    public function getPrincipal()
    {
        if (empty($this->schedule)) {
            return null;
        }

        $lastScheduleRow = $this->schedule->last();

        return $lastScheduleRow->getPrincipal();
    }

	public function getId() {
		return $this->id;
	}

    public function getInterest()
    {
        if (empty($this->schedule)) {
            return null;
        }

        $lastScheduleRow = $this->schedule->last();

        return $lastScheduleRow->getInterest();
    }

    public function getTotal()
    {
        if (empty($this->schedule)) {
            return null;
        }

        $lastScheduleRow = $this->schedule->last();

        return $lastScheduleRow->getTotal();
    }

    public function getLastPaymentDate()
    {
        if (empty($this->schedule)) {
            return null;
        }

        $lastScheduleRow = $this->schedule->last();

        return $lastScheduleRow->getDueDate();
    }

	/**
	 * @return string
	 */
	public function getPublicId() {
		return $this->publicId;
	}

	/**
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return \DateTime
	 */
	public function getNextPaymentDate() {
		return $this->nextPaymentDate;
	}

	/**
	 * @return int
	 */
	public function getTerm() {
		return $this->term;
	}

	/**
	 * @return string
	 */
	public function getLoanPeriodKind() {
		return $this->loanPeriodKind;
	}

	/**
	 * @return float
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @return float
	 */
	public function getInterestRate() {
		return $this->interestRate;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * @return bool
	 */
	public function isActive() {
		return $this->isActive;
	}

	/**
	 * @return bool
	 */
	public function isClosed() {
		return $this->isClosed;
	}

	/**
	 * @return int
	 */
	public function getAppliedRollovers() {
		return $this->appliedRollovers;
	}

	/**
	 * @return bool
	 */
	public function isRolloversEnabled() {
		return $this->rolloversEnabled;
	}

	/**
	 * @return int
	 */
	public function getMinRolloverTerm() {
		return $this->minRolloverTerm;
	}

	/**
	 * @return RolloverUnit
	 */
	public function getMinRolloverUnit() {
		return $this->minRolloverUnit;
	}

	/**
	 * @return int
	 */
	public function getMaxRolloverTerm() {
		return $this->maxRolloverTerm;
	}

	/**
	 * @return RolloverUnit
	 */
	public function getMaxRolloverUnit() {
		return $this->maxRolloverUnit;
	}

	/**
	 * @return int
	 */
	public function getMaxRollovers() {
		return $this->maxRollovers;
	}

	/**
	 * @return float
	 */
	public function getOutstandingBalancePrincipal() {
		return $this->outstandingBalancePrincipal;
	}

	/**
	 * @return float
	 */
	public function getOutstandingBalanceInterest() {
		return $this->outstandingBalanceInterest;
	}

	/**
	 * @return float
	 */
	public function getExpectedPaymentAmount() {
		return $this->expectedPaymentAmount;
	}

	/**
	 * @return string
	 */
	public function getCreditProductId() {
		return $this->creditProductId;
	}

	/**
	 * @return string
	 */
	public function getCreditProductName() {
		return $this->creditProductName;
	}
}