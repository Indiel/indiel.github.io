<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\MonthlyIncome as EnumClass;

class MonthlyIncome extends PhpEnum
{
    protected $name = 'monthly_income';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}