<?php

namespace AppBundle\Entity;

class CustomerBonuses
{
    /**
     * @param int $maxAmountDegree
     * @param int $maxTermDegree
     * @param int $interestRateDegree
     * @param int $bonusesTotal
     * @param int $bonusesBalance
     */
    public function __construct($maxAmountDegree = 0, $maxTermDegree = 0, $interestRateDegree = 0, $bonusesTotal = 0, $bonusesBalance = 0)
    {
        $this->maxAmountDegree = new BonusesDegree($maxAmountDegree); 
        $this->maxTermDegree = new BonusesDegree($maxTermDegree); 
        $this->interestRateDegree = new BonusesDegree($interestRateDegree);
        $this->bonusesTotal = $bonusesTotal;
        $this->bonusesBalance = $bonusesBalance;
    }

    /**
     * @var BonusesDegree
     */
    protected $maxAmountDegree;

    /**
     * @var BonusesDegree
     */
    protected $maxTermDegree;

    /**
     * @var BonusesDegree
     */
    protected $interestRateDegree;

    /**
     * @var int
     */
    protected $bonusesTotal;

    /**
     * @var int
     */
    protected $bonusesBalance;

    /**
     * @return BonusesDegree
     */
    public function getMaxAmountDegree()
    {
        return $this->maxAmountDegree;
    }

    /**
     * @return BonusesDegree
     */
    public function getMaxTermDegree()
    {
        return $this->maxTermDegree;
    }

    /**
     * @return BonusesDegree
     */
    public function getInterestRateDegree()
    {
        return $this->interestRateDegree;
    }

    /**
     * @return int
     */
    public function getBonusesTotal()
    {
        return $this->bonusesTotal;
    }

    /**
     * @return int
     */
    public function getBonusesBalance()
    {
        return $this->bonusesBalance;
    }
}