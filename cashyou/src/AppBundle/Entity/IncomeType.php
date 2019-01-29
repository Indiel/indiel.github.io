<?php

namespace AppBundle\Entity;

class IncomeType extends Enum
{
    const EMPLOYED = 1;
    const UNEMPLOYED = 2;
    const ENTREPRENEUR = 3;
    const STUDENT = 4;
    const PENSIONER = 5;
}