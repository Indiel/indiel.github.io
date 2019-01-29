<?php

namespace AppBundle\Entity;

class SecretQuestion extends Enum
{
    const NICKNAME = 1;
    const MOTHERS_MIDDLE_NAME = 2;
    const RELATIVE_CITY = 3;
    const YEAR_OF_GRADUATION = 4;
    const LAST_5_DIGITS_OF_CREDIT_CARD = 5;
}