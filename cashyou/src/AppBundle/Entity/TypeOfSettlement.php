<?php

namespace AppBundle\Entity;

class TypeOfSettlement extends Enum
{
    const CITY = 1;             // Місто
    const URBAN_VILLAGE = 2;    //Селище міського типу
    const SETTLEMENT = 3;       //Селище
    const VILLAGE = 4;          //Село
    const STEADING = 5;         //Хутір
}