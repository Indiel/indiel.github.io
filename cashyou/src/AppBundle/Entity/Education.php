<?php

namespace AppBundle\Entity;

class Education extends Enum
{
    const SECONDARY_UNFINISHED = 1;
    const SECONDARY = 2;
    const HIGHER_UNFINISHED = 3;
    const HIGHER = 4;
    const FEW_HIGHER = 5;
    const ACADEMIC_DEGREE = 6;
}