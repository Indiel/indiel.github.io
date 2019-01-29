<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\Gender as EnumClass;

class Gender extends PhpEnum
{
    protected $name = 'gender';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}