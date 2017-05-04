<?php

namespace MMC\FestivalBundle\Services\Carousel;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarouselView
{
    protected $name;

    protected $images;

    protected $options;

    public function __construct($name, $options = [])
    {
        $this->name = $name;
        $this->images = new ArrayCollection();
        $this->setOptions($options);
    }

    public function getName()
    {
        return $this->name;
    }

    public function addImage(CarouselImageView $image)
    {
        $this->images->add($image);
    }

    public function getImages()
    {
        return $this->images->toArray();
    }

    public function clear()
    {
        $this->images->clear();
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'class' => 'poster',
            'showControls' => true,
            'showIndicators' => true,
            'interval' => 5000,
            'imagine_filter' => null,
        ]);

        $resolver->setAllowedTypes('class', 'string');
        $resolver->setAllowedTypes('showControls', 'boolean');
        $resolver->setAllowedTypes('showIndicators', 'boolean');
        $resolver->setAllowedTypes('interval', 'integer');
        $resolver->setAllowedTypes('imagine_filter', ['null', 'string']);

        $this->options = $resolver->resolve($options);

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
