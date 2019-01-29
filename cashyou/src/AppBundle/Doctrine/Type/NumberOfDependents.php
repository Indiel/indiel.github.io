<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\NumberOfDependents as EnumClass;

class NumberOfDependents extends PhpEnum
{
    protected $name = 'number_of_dependents';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}