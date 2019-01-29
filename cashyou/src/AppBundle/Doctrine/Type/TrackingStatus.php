<?php

namespace AppBundle\Doctrine\Type;

use AppBundle\Entity\TrackingStatus as EnumClass;

class TrackingStatus extends PhpEnum
{
    protected $name = 'tracking_status';
    protected $sqlType = 'string';
    protected $phpType = EnumClass::class;
}