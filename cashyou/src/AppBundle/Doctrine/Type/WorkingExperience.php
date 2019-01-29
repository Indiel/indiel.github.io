<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\WorkingExperience as EnumClass;

class WorkingExperience extends PhpEnum
{
    protected $name = 'working_experience';
    protected $sqlType = 'integer';
    protected $phpType = EnumClass::class;
}