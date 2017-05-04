<?php

namespace MMC\FestivalBundle\Services\Carousel;

interface Carousel
{
    public function supports($name);

    public function getView($name);
}
