<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Helper\PhoneVerifyStorage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneVerifyValidator extends ConstraintValidator
{
    /**
     * @var PhoneVerifyStorage
     */
    protected $verifyStorage;
    
    public function __construct(PhoneVerifyStorage $verifyStorage)
    {
        $this->verifyStorage = $verifyStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$this->verifyStorage->isVerified($value)) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}