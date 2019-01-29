<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\RolloverUnit as EnumClass;

class RolloverUnit extends PhpEnum
{
    protected $name = 'rollover_unit';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}