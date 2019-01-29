<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\IncomeType as EnumClass;

class IncomeType extends PhpEnum
{
    protected $name = 'income_type';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}