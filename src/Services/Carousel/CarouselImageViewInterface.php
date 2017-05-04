<?php

namespace MMC\FestivalBundle\Services\Carousel;

interface CarouselImageViewInterface
{
    public function getSrc();

    public function getAlt();

    public function getTitle();

    public function getCaption();

    public function getLink();
}
