<?php

namespace MMC\FestivalBundle\Services\Carousel;

abstract class AbstractCarousel implements Carousel
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function supports($name)
    {
        return $name == $this->name;
    }

    public function getView($name)
    {
        if ($this->supports($name)) {
            return $this->_getView();
        }

        return;
    }

    abstract protected function _getView();
}
