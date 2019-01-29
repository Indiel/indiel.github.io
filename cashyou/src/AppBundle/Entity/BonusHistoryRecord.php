<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

class BonusHistoryRecord
{
    use EnumSerializeDeserialize;
    
    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Id")
     */
    protected $id;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @Serializer\SerializedName("Date")
     */
    protected $date;

    /**
     * @var EventTypeId
     * @Serializer\Type("int")
     * @Serializer\SerializedName("EventId")
     * @Serializer\Accessor(getter="getEnumEventId", setter="setEnumEventId_EventTypeId")
     */
    protected $eventId;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Earned")
     */
    protected $earned;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Spent")
     */
    protected $spent;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Balance")
     */
    protected $balance;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Action")
     */
    protected $action;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Comment")
     */
    protected $comment;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CustomerId")
     */
    protected $customerId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ReferalId")
     */
    protected $referalId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ManagerId")
     */
    protected $managerId;

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SerializedName("LoanId")
     */
    protected $loanId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("LoanPublicId")
     */
    protected $loanPublicId;

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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return EventTypeId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param EventTypeId $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return int
     */
    public function getEarned()
    {
        return $this->earned;
    }

    /**
     * @param int $earned
     */
    public function setEarned($earned)
    {
        $this->earned = $earned;
    }

    /**
     * @return int
     */
    public function getSpent()
    {
        return $this->spent;
    }

    /**
     * @param int $spent
     */
    public function setSpent($spent)
    {
        $this->spent = $spent;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getReferalId()
    {
        return $this->referalId;
    }

    /**
     * @param string $referalId
     */
    public function setReferalId($referalId)
    {
        $this->referalId = $referalId;
    }

    /**
     * @return string
     */
    public function getManagerId()
    {
        return $this->managerId;
    }

    /**
     * @param string $managerId
     */
    public function setManagerId($managerId)
    {
        $this->managerId = $managerId;
    }

    /**
     * @return int
     */
    public function getLoanId()
    {
        return $this->loanId;
    }

    /**
     * @param int $loanId
     */
    public function setLoanId($loanId)
    {
        $this->loanId = $loanId;
    }

    /**
     * @return string
     */
    public function getLoanPublicId()
    {
        return $this->loanPublicId;
    }

    /**
     * @param string $loanPublicId
     */
    public function setLoanPublicId($loanPublicId)
    {
        $this->loanPublicId = $loanPublicId;
    }
}