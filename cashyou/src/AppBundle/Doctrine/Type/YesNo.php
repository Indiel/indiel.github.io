<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\YesNo as EnumClass;

class YesNo extends PhpEnum
{
    protected $name = 'yesno';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}