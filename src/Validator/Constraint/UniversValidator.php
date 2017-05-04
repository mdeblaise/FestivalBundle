<?php

namespace MMC\FestivalBundle\Validator\Constraint;

use MMC\FestivalBundle\Model\Univers as ModelUnivers;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniversValidator extends ConstraintValidator
{
    protected $class;

    public function __construct(
        $class
    ) {
        $this->class = $class;

        if (!is_a($this->class, ModelUnivers::class, true)) {
            throw new \LogicException(
                'The first parameter "class" must be a class that inherits from '.ModelUnivers::class
            );
        }
    }

    public function validate($value, Constraint $constraint)
    {
        $choices = call_user_func([$this->class, 'getConstants'], 'strtolower');

        if (!in_array($value, $choices)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }
}
