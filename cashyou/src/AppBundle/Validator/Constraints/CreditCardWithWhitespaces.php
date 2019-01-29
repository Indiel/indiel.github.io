<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\CardScheme;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class CreditCardWithWhitespaces extends CardScheme
{

}