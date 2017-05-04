<?php

namespace MMC\FestivalBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Univers extends Constraint
{
    public $message = 'bad-univers';

    public function validatedBy()
    {
        return 'mmc_festival.univers.validator';
    }
}
