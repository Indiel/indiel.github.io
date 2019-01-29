<?php

namespace AppBundle\Entity;

class LoyalityParameters
{
    /**
     * @var int[]
     */
    protected $maxAmount;

    /**
     * @var int[]
     */
    protected $maxTerm;

    /**
     * @var int[]
     */
    protected $interestRate;
    
    public function __construct($maxAmount, $maxTerm, $interestRate)
    {
        $this->maxAmount = $maxAmount;
        $this->maxTerm = $maxTerm;
        $this->interestRate = $interestRate;
    }

    /**
     * @return int[]
     */
    public function getMaxAmount()
    {
        return $this->maxAmount;
    }

    /**
     * @return int[]
     */
    public function getMaxTerm()
    {
        return $this->maxTerm;
    }

    /**
     * @return int[]
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }
}