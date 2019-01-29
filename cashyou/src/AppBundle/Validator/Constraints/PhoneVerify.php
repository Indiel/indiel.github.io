<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PhoneVerify extends Constraint
{
    public $message = 'Телефон не подтвержден';

    public function validatedBy()
    {
        return 'app.phone_verify_validator';
    }
}