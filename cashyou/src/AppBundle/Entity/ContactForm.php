<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ContactForm
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $phone;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}