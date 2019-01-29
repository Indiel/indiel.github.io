<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\Position as EnumClass;

class Position extends PhpEnum
{
    protected $name = 'position';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}