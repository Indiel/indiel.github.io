<?php

namespace AppBundle\Entity;

class MonthlyIncome extends Enum
{
    const UNDER_3200 = 1;
    const FROM_3200_TO_5000 = 2;
    const FROM_5000_TO_8000 = 3;
    const FROM_8000_TO_15000 = 4;
    const MORE_THAN_15000 = 5;
}