<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\MaritalStatus as EnumClass;

class MaritalStatus extends PhpEnum
{
    protected $name = 'marital_status';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}