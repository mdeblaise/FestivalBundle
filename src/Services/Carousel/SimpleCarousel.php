<?php

namespace MMC\FestivalBundle\Services\Carousel;

use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleCarousel extends AbstractCarousel
{
    protected $view;

    public function __construct($name, $items = [])
    {
        parent::__construct($name);

        $this->view = new CarouselView($this->name);

        $this->resolver = new OptionsResolver();
        $this->resolver->setRequired(['src']);
        $this->resolver->setDefaults([
            'title' => '',
            'alt' => '',
            'caption' => '',
            'link' => '',
        ]);

        $this->resolver->setAllowedTypes('src', 'string');
        $this->resolver->setAllowedTypes('title', 'string');
        $this->resolver->setAllowedTypes('alt', 'string');
        $this->resolver->setAllowedTypes('caption', 'string');
        $this->resolver->setAllowedTypes('link', 'string');

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem($options)
    {
        $options = $this->resolver->resolve($options);

        $image = new CarouselImageView();
        $image->setSrc($options['src'])
            ->setTitle($options['title'])
            ->setAlt($options['alt'])
            ->setCaption($options['caption'])
            ->setLink($options['link'])
            ;

        $this->view->addImage($image);
    }

    protected function _getView()
    {
        return $this->view;
    }
}
