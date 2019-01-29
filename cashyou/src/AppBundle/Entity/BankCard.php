<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;

class BankCard
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $cardHolderName;

    /**
     * @var string
     * @CustomAssert\CreditCardWithWhitespaces(
     *     schemes={"VISA", "MASTERCARD"},
     *     message="Неправильный номер карты."
     * )
     */
    private $number;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}$/",
     * )
     */
    private $expirationMonth;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}$/",
     * )
     */
    private $expirationYear;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]{3,4}$/",
     * )
     */
    private $cvv;

    /**
     * @return string
     */
    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }

    /**
     * @param string $cardHolderName
     */
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumberClean()
    {
        return str_replace(' ', '', $this->number);
    }

    /**
     * @return string
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * @param string $expirationMonth
     */
    public function setExpirationMonth($expirationMonth)
    {
        $this->expirationMonth = $expirationMonth;
    }

    /**
     * @return string
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * @param string $expirationYear
     */
    public function setExpirationYear($expirationYear)
    {
        $this->expirationYear = $expirationYear;
    }

    /**
     * @return string
     */
    public function getExpirationYearFull()
    {
        return $this->expirationYear ? substr(date('Y'), 0, 2) . $this->expirationYear : $this->expirationYear;
    }

    /**
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }
}