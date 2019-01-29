<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="repayment_rows")
 */
class RepaymentRow
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Loan|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Loan", inversedBy="repayments")
     * @ORM\JoinColumn(name="loan_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $loan;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @Serializer\SerializedName("OperationDate")
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    protected $operationDate;

    /**
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\SerializedName("IsAutoCharge")
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isAutoCharge;

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
     * @Serializer\SerializedName("AmountLeft")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $amountLeft;


    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Principal")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $principal;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("BaseInterest")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $baseInterest;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("PastDueInterest")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $pastDueInterest;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Fees")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $fees;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("AdministrationFee")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $administrationFee;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("OutstandingPrincipal")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $outstandingPrincipal;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PaymentType")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $paymentType;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ServiceId")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $serviceId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("OperatorId")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $operatorId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Comments")
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comments;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Status")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $status;

    /**
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\SerializedName("IsSuccessful")
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isSuccessful;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Loan|null
     */
    public function getLoan()
    {
        return $this->loan;
    }

    /**
     * @param Loan|null $loan
     */
    public function setLoan($loan)
    {
        $this->loan = $loan;
    }

    /**
     * @return \DateTime
     */
    public function getOperationDate()
    {
        return $this->operationDate;
    }

    /**
     * @param \DateTime $operationDate
     */
    public function setOperationDate($operationDate)
    {
        $this->operationDate = $operationDate;
    }

    /**
     * @return bool
     */
    public function isAutoCharge()
    {
        return $this->isAutoCharge;
    }

    /**
     * @param bool $isAutoCharge
     */
    public function setIsAutoCharge($isAutoCharge)
    {
        $this->isAutoCharge = $isAutoCharge;
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
    public function getAmountLeft()
    {
        return $this->amountLeft;
    }

    /**
     * @param float $amountLeft
     */
    public function setAmountLeft($amountLeft)
    {
        $this->amountLeft = $amountLeft;
    }

    /**
     * @return float
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * @param float $principal
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    }

    /**
     * @return float
     */
    public function getBaseInterest()
    {
        return $this->baseInterest;
    }

    /**
     * @param float $baseInterest
     */
    public function setBaseInterest($baseInterest)
    {
        $this->baseInterest = $baseInterest;
    }

    /**
     * @return float
     */
    public function getPastDueInterest()
    {
        return $this->pastDueInterest;
    }

    /**
     * @param float $pastDueInterest
     */
    public function setPastDueInterest($pastDueInterest)
    {
        $this->pastDueInterest = $pastDueInterest;
    }

    /**
     * @return float
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * @param float $fees
     */
    public function setFees($fees)
    {
        $this->fees = $fees;
    }

    /**
     * @return float
     */
    public function getAdministrationFee()
    {
        return $this->administrationFee;
    }

    /**
     * @param float $administrationFee
     */
    public function setAdministrationFee($administrationFee)
    {
        $this->administrationFee = $administrationFee;
    }

    /**
     * @return float
     */
    public function getOutstandingPrincipal()
    {
        return $this->outstandingPrincipal;
    }

    /**
     * @param float $outstandingPrincipal
     */
    public function setOutstandingPrincipal($outstandingPrincipal)
    {
        $this->outstandingPrincipal = $outstandingPrincipal;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return string
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getOperatorId()
    {
        return $this->operatorId;
    }

    /**
     * @param string $operatorId
     */
    public function setOperatorId($operatorId)
    {
        $this->operatorId = $operatorId;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->isSuccessful;
    }

    /**
     * @param bool $isSuccessful
     */
    public function setIsSuccessful($isSuccessful)
    {
        $this->isSuccessful = $isSuccessful;
    }
}