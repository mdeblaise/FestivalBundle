<?php

namespace MMC\FestivalBundle\Services;

use MMC\FestivalBundle\Model\Univers;

class EnumUniversProvider implements EnumUniversProviderInterface
{
    protected $class;

    public function __construct(
        $class
    ) {
        $this->class = $class;

        if (!is_a($this->class, Univers::class, true)) {
            throw new \LogicException(
                'The first parameter "class" must be a class that inherits from '.Univers::class
            );
        }
    }

    public function getClassname()
    {
        return $this->class;
    }

    public function getCodes()
    {
        return call_user_func([$this->class, 'getKeys'], 'strtolower');
    }

    public function getValues()
    {
        return call_user_func([$this->class, 'getConstants'], 'strtolower');
    }
}
