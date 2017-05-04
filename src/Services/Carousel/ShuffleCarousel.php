<?php

namespace MMC\FestivalBundle\Services\Carousel;

class ShuffleCarousel implements Carousel
{
    protected $carousel;

    public function __construct(Carousel $carousel)
    {
        $this->carousel = $carousel;
    }

    public function supports($request)
    {
        return $this->carousel->supports($request);
    }

    public function getView($request)
    {
        $view = $this->carousel->getView($request);
        if (!$view) {
            return;
        }

        $images = $view->getImages();
        shuffle($images);
        $view->clear();

        foreach ($images as $image) {
            $view->addImage($image);
        }

        return $view;
    }
}
