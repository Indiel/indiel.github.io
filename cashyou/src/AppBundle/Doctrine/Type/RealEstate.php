<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\RealEstate as EnumClass;

class RealEstate extends PhpEnum
{
    protected $name = 'real_estate';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}