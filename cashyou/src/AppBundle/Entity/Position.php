<?php

namespace AppBundle\Entity;

class Position extends Enum
{
    const HEAD = 1;
    const DEPUTY_HEAD = 2;
    const MANAGER = 3;
    const SPECIALIST = 4;
    const WORKER = 5;
    const AUXILIARY_STAFF = 6;
}