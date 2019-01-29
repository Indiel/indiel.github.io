<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordForm
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="6")
     */
    private $password;

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}