<?php

namespace AppBundle\Entity;

class TrackingStatus extends Enum
{
    const LEAD = 'lead';
    const REJECTED = 'rejected';
    const SALE = 'sale';
}