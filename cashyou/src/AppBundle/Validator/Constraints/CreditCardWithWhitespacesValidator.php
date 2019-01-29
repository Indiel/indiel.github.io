<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\CardSchemeValidator;

class CreditCardWithWhitespacesValidator extends CardSchemeValidator
{
    public function validate($value, Constraint $constraint)
    {
        parent::validate(str_replace(' ', '', $value), $constraint);
    }
}