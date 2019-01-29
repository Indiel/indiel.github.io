<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\Education as EnumClass;

class Education extends PhpEnum
{
    protected $name = 'education';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}