<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\SecretQuestion as EnumClass;

class SecretQuestion extends PhpEnum
{
    protected $name = 'secret_question';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}