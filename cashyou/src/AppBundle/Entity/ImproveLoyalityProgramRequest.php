<?php

namespace AppBundle\Entity;

class ImproveLoyalityProgramRequest implements ApiExportableInterface
{
    use ApiExportable;
    
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
    
    public function __construct(BonusesDegree $maxAmountDegree = null, $maxTermDegree = null, $interestRateDegree = null)
    {
        $this->maxAmountDegree = $maxAmountDegree ? $maxAmountDegree : new BonusesDegree(0);
        $this->maxTermDegree = $maxTermDegree ? $maxTermDegree : new BonusesDegree(0);
        $this->interestRateDegree = $interestRateDegree ? $interestRateDegree : new BonusesDegree(0);
    }

    /**
     * @return mixed
     */
    public function getMaxAmountDegree()
    {
        return $this->maxAmountDegree;
    }

    /**
     * @param mixed $maxAmountDegree
     */
    public function setMaxAmountDegree($maxAmountDegree)
    {
        $this->maxAmountDegree = $maxAmountDegree;
    }

    /**
     * @return BonusesDegree
     */
    public function getMaxTermDegree()
    {
        return $this->maxTermDegree;
    }

    /**
     * @param BonusesDegree $maxTermDegree
     */
    public function setMaxTermDegree($maxTermDegree)
    {
        $this->maxTermDegree = $maxTermDegree;
    }

    /**
     * @return BonusesDegree
     */
    public function getInterestRateDegree()
    {
        return $this->interestRateDegree;
    }

    /**
     * @param BonusesDegree $interestRateDegree
     */
    public function setInterestRateDegree($interestRateDegree)
    {
        $this->interestRateDegree = $interestRateDegree;
    }
}