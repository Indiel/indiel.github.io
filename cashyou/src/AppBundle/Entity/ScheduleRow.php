<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="schedule_rows")
 */
class ScheduleRow
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Loan", inversedBy="schedule")
     * @ORM\JoinColumn(name="loan_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $loan;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Total")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $total;

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
     * @Serializer\SerializedName("Interest")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $interest;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Principal")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $principal;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Status")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $status;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("DueDate")
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    protected $dueDate;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("PastDueInterest")
     * @ORM\Column(type="float", nullable=true)
     */
    protected $pastDueInterest;

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
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
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
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param float $interest
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
    }

    /**
     * @return int
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * @param int $principal
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
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
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
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
    
    public function isPaid()
    {
        return in_array($this->status, [
            'PaidOnTime',
            'PaidEarly',
            'PaidLate',
        ]);
    }
}