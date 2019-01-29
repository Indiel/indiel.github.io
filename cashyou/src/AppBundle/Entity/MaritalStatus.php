<?php

namespace AppBundle\Entity;

class MaritalStatus extends Enum
{
    const MARRIED = 1;
    const UNMARRIED = 2;
    const DIVORCED = 3;
    const WIDOWER = 4;
    const CIVIL_MARRIAGE = 5;
}