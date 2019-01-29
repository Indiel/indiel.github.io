<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\BusinessType as EnumClass;

class BusinessType extends PhpEnum
{
    protected $name = 'business_type';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}