<?php

namespace AppBundle\Entity;

class RealEstate extends Enum
{
    const PURCHASED = 1;
    const RENT = 2;
    const LIVING_WITH_RELATIVES = 3;
    const HOSTEL = 4;
}