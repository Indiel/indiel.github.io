<?php

namespace AppBundle\Entity;

class EventTypeId extends Enum
{
    const REG_EVENT = 1;
    const ADD_DOC_EVENT = 2;
    const REPAID_LOAN_EVENT = 3;
    const SOCIAL_EVENT = 4;
    const FIRST_APPROVED_EVENT = 5;
    const REPAID_LOAN_REFERAL_EVENT = 6;
}