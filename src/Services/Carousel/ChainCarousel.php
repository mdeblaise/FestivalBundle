<?php

namespace MMC\FestivalBundle\Services\Carousel;

class ChainCarousel implements Carousel
{
    protected $carousels;

    public function __construct()
    {
        $this->carousels = [];
    }

    public function addCarousel(Carousel $carousel)
    {
        $this->carousels[] = $carousel;
    }

    public function supports($request)
    {
        foreach ($this->carousels as $carousel) {
            if ($carousel->support($request)) {
                return true;
            }
        }

        return false;
    }

    public function getView($request)
    {
        foreach ($this->carousels as $carousel) {
            if ($carousel->supports($request)) {
                return $carousel->getView($request);
            }
        }

        return;
    }
}
