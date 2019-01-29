<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

class Card
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CardPan")
     */
    protected $cardPan;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CardType")
     */
    protected $cardType;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("IssuerBankCountry")
     */
    protected $issuerBankCountry;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("IssuerBankName")
     */
    protected $issuerBankName;

    /**
     * @param bool $formatTo16
     * @return string
     */
    public function getCardPan($formatTo16 = true)
    {
        return empty($this->cardPan) || !$formatTo16 || (strlen($this->cardPan) == 16) ? $this->cardPan : str_replace('****', '**********', $this->cardPan);
    }

    /**
     * @param string $cardPan
     */
    public function setCardPan($cardPan)
    {
        $this->cardPan = $cardPan;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @param string $cardType
     */
    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
    }

    /**
     * @return string
     */
    public function getIssuerBankCountry()
    {
        return $this->issuerBankCountry;
    }

    /**
     * @param string $issuerBankCountry
     */
    public function setIssuerBankCountry($issuerBankCountry)
    {
        $this->issuerBankCountry = $issuerBankCountry;
    }

    /**
     * @return string
     */
    public function getIssuerBankName()
    {
        return $this->issuerBankName;
    }

    /**
     * @param string $issuerBankName
     */
    public function setIssuerBankName($issuerBankName)
    {
        $this->issuerBankName = $issuerBankName;
    }
}