<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\TypeOfSettlement as EnumClass;

class TypeOfSettlement extends PhpEnum
{
    protected $name = 'type_of_settlement';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}