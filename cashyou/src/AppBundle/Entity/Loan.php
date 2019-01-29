<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="loans")
 */
class Loan
{
    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Id")
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="loans")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PublicId")
     * @ORM\Column(type="string", length=1000)
     */
    protected $publicId;
    
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Status")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $status;

    /**
     * @var ArrayCollection|ScheduleRow[]
     * @Serializer\Type("ArrayCollection<AppBundle\Entity\ScheduleRow>")
     * @Serializer\SerializedName("Schedule")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ScheduleRow", mappedBy="loan", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $schedule;

    /**
     * @var ArrayCollection|RepaymentRow[]
     * @Serializer\Type("ArrayCollection<AppBundle\Entity\RepaymentRow>")
     * @Serializer\SerializedName("Repayments")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RepaymentRow", mappedBy="loan", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $repayments;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("NextPaymentDate")
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    protected $nextPaymentDate;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Term")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $term;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("LoanPeriodKind")
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $loanPeriodKind;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Amount")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $amount;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("InterestRate")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $interestRate;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @Serializer\SerializedName("CreationDate")
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    protected $creationDate;

    /**
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\SerializedName("IsActive")
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\SerializedName("IsClosed")
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isClosed;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("AppliedRollovers")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $appliedRollovers;

    /**
     * @var boolean
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("RolloversEnabled")
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $rolloversEnabled;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MinRolloverTerm")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $minRolloverTerm;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("RolloverDays")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $rolloverDays;

    /**
     * @var RolloverUnit
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MinRolloverUnit")
     * @Serializer\Accessor(getter="getMinRolloverUnit", setter="setMinRolloverUnit")
     * @ORM\Column(type="rollover_unit", nullable=true)
     */
    protected $minRolloverUnit;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MaxRolloverTerm")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $maxRolloverTerm;

    /**
     * @var RolloverUnit
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MaxRolloverUnit")
     * @Serializer\Accessor(getter="getMaxRolloverUnit", setter="setMaxRolloverUnit")
     * @ORM\Column(type="rollover_unit", nullable=true)
     */
    protected $maxRolloverUnit;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MaxRollovers")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $maxRollovers;

    /**
     * @var ArrayCollection|LoanAgreementDocument[]
     * @Serializer\Type("ArrayCollection<AppBundle\Entity\LoanAgreementDocument>")
     * @Serializer\SerializedName("DocumentsToSign")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LoanAgreementDocument", mappedBy="loan", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $documentsToSign;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("OutstandingBalance_Principal")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $outstandingBalancePrincipal;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("OutstandingBalance_Interest")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $outstandingBalanceInterest;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("ExpectedPaymentAmount")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $expectedPaymentAmount;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CreditProductId")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $creditProductId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CreditProductName")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $creditProductName;

    const MAX_TERM_DAYS = '30';
    const MAX_DAYS_TO_PAY_FOR_ROLLOVER = '5';

    public function __construct()
    {
        $this->schedule = new ArrayCollection();
        $this->repayments = new ArrayCollection();
        $this->documentsToSign = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @param string $publicId
     */
    public function setPublicId($publicId)
    {
        $this->publicId = $publicId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusRT()
    {
        switch ($this->getStatus()) {
            case 'PreOrigination';
            case 'Origination';
            case 'Reprocessing';
            case 'AutoProcessing';
            case 'P2P_GatheringInvestments';
            case 'WaitingForCustomerSignature';
            case 'Closed_AgreementDeclined';
            case 'Closed_AgreementExpired';
                $status_id = 1;
                break;
            case 'Closed_Rejected';
                $status_id = 2;
                break;
            case 'Approved';
            case 'DisbursementFailed';
            case 'DisbursementInProgress';
                $status_id = 3;
                break;
            case 'Active';
            case 'RolloverRequested';
                $status_id = 4;
                break;
            case 'Closed_Repaid';
            case 'Closed_WrittenOff';
            case 'Closed_Restructured';
                $status_id = 5;
                break;
            case 'PastDue';
            case 'Collateral';
                $status_id = 6;
                break;
            default:
                $status_id = NULL;
        }
        return $status_id;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return ArrayCollection|ScheduleRow[]
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param ScheduleRow[] $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return \DateTime
     */
    public function getNextPaymentDate()
    {
        return $this->nextPaymentDate;
    }

    /**
     * @param \DateTime $nextPaymentDate
     */
    public function setNextPaymentDate($nextPaymentDate)
    {
        $this->nextPaymentDate = $nextPaymentDate;
    }

    /**
     * @return int
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param int $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    public function getLoanPeriodKind()
    {
        return $this->loanPeriodKind;
    }

    /**
     * @param string $loanPeriodKind
     */
    public function setLoanPeriodKind($loanPeriodKind)
    {
        $this->loanPeriodKind = $loanPeriodKind;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    /**
     * @param float $interestRate
     */
    public function setInterestRate($interestRate)
    {
        $this->interestRate = $interestRate;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->isClosed;
    }

    /**
     * @param bool $closed
     */
    public function setClosed($closed)
    {
        $this->isClosed = $closed;
    }

    /**
     * @return int
     */
    public function getAppliedRollovers()
    {
        return $this->appliedRollovers;
    }

    /**
     * @param int $appliedRollovers
     */
    public function setAppliedRollovers($appliedRollovers)
    {
        $this->appliedRollovers = $appliedRollovers;
    }

    /**
     * @return int
     */
    public function isRolloversEnabled()
    {
        return $this->rolloversEnabled;
    }

    /**
     * @param int $rolloversEnabled
     */
    public function setRolloversEnabled($rolloversEnabled)
    {
        $this->rolloversEnabled = $rolloversEnabled;
    }

    /**
     * @return int
     */
    public function rolloverDays()
    {
        return $this->rolloverDays;
    }

    /**
     * @param int $rolloverDays
     */
    public function setRolloverDays($rolloverDays)
    {
        $this->rolloverDays = $rolloverDays;
    }

    /**
     * @return int
     */
    public function getMinRolloverTerm()
    {
        return $this->minRolloverTerm;
    }

    /**
     * @param int $minRolloverTerm
     */
    public function setMinRolloverTerm($minRolloverTerm)
    {
        $this->minRolloverTerm = $minRolloverTerm;
    }

    /**
     * @return RolloverUnit
     */
    public function getMinRolloverUnit()
    {
        return $this->minRolloverUnit;
    }

    /**
     * @return int
     */
    public function getMinRolloverTermDays()
    {
        if (!$this->minRolloverTerm) {
            return 0;
        }

        if ($this->minRolloverUnit->getValue() == RolloverUnit::DAYS) {
            return $this->minRolloverTerm;
        }

        if ($this->minRolloverUnit->getValue() == RolloverUnit::WEEKS) {
            return $this->minRolloverTerm * 7;
        }

        $newDate = $this->nextPaymentDate;
        $newDate->modify('+'.$this->minRolloverTerm.' month');

        return $this->nextPaymentDate->diff($newDate)->d;
    }

    /**
     * @param $minRolloverUnit
     */
    public function setMinRolloverUnit($minRolloverUnit)
    {
        $this->minRolloverUnit = $minRolloverUnit instanceof RolloverUnit ? $minRolloverUnit : new RolloverUnit($minRolloverUnit);
    }

    /**
     * @return int
     */
    public function getMaxRolloverTerm()
    {
        return $this->maxRolloverTerm;
    }

    /**
     * @return int
     */
    public function getMaxRolloverTermDays()
    {
        if (!$this->maxRolloverTerm) {
            return 0;
        }

        if ($this->maxRolloverUnit->getValue() == RolloverUnit::DAYS) {
            $maxDays = $this->maxRolloverTerm > self::MAX_TERM_DAYS ? self::MAX_TERM_DAYS : $this->maxRolloverTerm;
            return $this->isExpired() ? $maxDays : $maxDays - $this->getDaysUntilNextPayment();
        }

        if ($this->maxRolloverUnit->getValue() == RolloverUnit::WEEKS) {
            return $this->maxRolloverTerm * 7;
        }

        $newDate = $this->nextPaymentDate;
        $newDate->modify('+'.$this->maxRolloverTerm.' month');

        return $this->nextPaymentDate->diff($newDate)->d;
    }

    /**
     * @param int $maxRolloverTerm
     */
    public function setMaxRolloverTerm($maxRolloverTerm)
    {
        $this->maxRolloverTerm = $maxRolloverTerm;
    }

    /**
     * @return RolloverUnit
     */
    public function getMaxRolloverUnit()
    {
        return $this->maxRolloverUnit;
    }

    /**
     * @param $maxRolloverUnit
     */
    public function setMaxRolloverUnit($maxRolloverUnit)
    {
        $this->maxRolloverUnit = $maxRolloverUnit instanceof RolloverUnit ? $maxRolloverUnit : new RolloverUnit($maxRolloverUnit);
    }

    /**
     * @return int
     */
    public function getMaxRollovers()
    {
        return $this->maxRollovers;
    }

    /**
     * @param int $maxRollovers
     */
    public function setMaxRollovers($maxRollovers)
    {
        $this->maxRollovers = $maxRollovers;
    }

    /**
     * @return ArrayCollection|LoanAgreementDocument[]
     */
    public function getDocumentsToSign()
    {
        return $this->documentsToSign;
    }

    /**
     * @param LoanAgreementDocument[] $documentsToSign
     */
    public function setDocumentsToSign($documentsToSign)
    {
        $this->documentsToSign = $documentsToSign;
    }

    /**
     * @return float
     */
    public function getOutstandingBalancePrincipal()
    {
        return $this->outstandingBalancePrincipal;
    }

    /**
     * @param float $outstandingBalancePrincipal
     */
    public function setOutstandingBalancePrincipal($outstandingBalancePrincipal)
    {
        $this->outstandingBalancePrincipal = $outstandingBalancePrincipal;
    }

    /**
     * @return float
     */
    public function getOutstandingBalanceInterest()
    {
        return $this->outstandingBalanceInterest;
    }

    /**
     * @param float $outstandingBalanceInterest
     */
    public function setOutstandingBalanceInterest($outstandingBalanceInterest)
    {
        $this->outstandingBalanceInterest = $outstandingBalanceInterest;
    }

    /**
     * @return int
     */
    public function getDaysUntilNextPayment()
    {
        $now = new \DateTime();
        
        $diff = $now->diff($this->nextPaymentDate);
        
        return intval($diff->format('%a')) * ($diff->invert ? -1 : 1);
    }

    /**
     * @deprecated Use getExpectedPaymentAmount() instead. Left for BC reasons only.
     * @return float
     */
    public function getTotalToRepay()
    {
        return $this->getExpectedPaymentAmount();
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        $now = new \DateTime();

        $diff = $now->diff($this->nextPaymentDate);

        return $diff->invert ? true : false;
    }

    /**
     * @return bool
     */
    public function canRollover()
    {
        $now = new \DateTime();
        $diff = $now->diff($this->creationDate);
        $daysFromCreationDate = intval($diff->format('%a'));
        $abilityByNextPayment = $this->isExpired() ? true : ($this->getDaysUntilNextPayment() <= self::MAX_DAYS_TO_PAY_FOR_ROLLOVER);

        return ($this->rolloverDays > 0)
            && ($this->appliedRollovers < $this->maxRollovers)
            && $this->maxRolloverTerm
            && in_array($this->status, [
                'Active',
                'PastDue',
            ])
            && $daysFromCreationDate >= 1
            && $abilityByNextPayment;
    }
    
    public function isProcessing()
    {
        return in_array($this->status, [
            'PreOrigination',
            'Origination',
            'Reprocessing',
            'AutoProcessing',
            'Approved',
            'DisbursementFailed',
            'DisbursementInProgress',
            'WaitingForApproval',
        ]);
    }

    /**
     * @return float
     */
    public function getExpectedPaymentAmount()
    {
        return $this->expectedPaymentAmount;
    }

    /**
     * @param float $expectedPaymentAmount
     */
    public function setExpectedPaymentAmount($expectedPaymentAmount)
    {
        $this->expectedPaymentAmount = $expectedPaymentAmount;
    }
    
    public function getTotalPayedAmount()
    {
        return array_sum(
            array_map(
                function(RepaymentRow $repaymentRow){
                    return $repaymentRow->getAmount();
                },
                $this->repayments->toArray()
            )
        );
    }
    
    public function getLastPaymentDate()
    {
        if (empty($this->schedule)) {
            return null;
        }
        
        $lastScheduleRow = $this->schedule->last();
        
        return $lastScheduleRow->getDueDate();
    }

    public function getPrincipal()
    {
        if (empty($this->schedule)) {
            return null;
        }

        $lastScheduleRow = $this->schedule->last();

        return $lastScheduleRow->getPrincipal();
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

    /**
     * @return ArrayCollection|RepaymentRow[]
     */
    public function getRepayments()
    {
        return $this->repayments;
    }

    /**
     * @param RepaymentRow[] $repayments
     */
    public function setRepayments($repayments)
    {
        $this->repayments = $repayments;
    }

    /**
     * @return mixed
     */
    public function getCreditProductId()
    {
        return $this->creditProductId;
    }

    /**
     * @param mixed $creditProductId
     */
    public function setCreditProductId($creditProductId)
    {
        $this->creditProductId = $creditProductId;
    }

    /**
     * @return string
     */
    public function getCreditProductName()
    {
        return $this->creditProductName;
    }

    /**
     * @param string $creditProductName
     */
    public function setCreditProductName($creditProductName)
    {
        $this->creditProductName = $creditProductName;
    }

    public function getRolloverRepayAmount()
    {
    	return max(0, $this->expectedPaymentAmount - $this->getPrincipal());
    }
}