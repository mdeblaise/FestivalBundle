<?php

namespace MMC\FestivalBundle\Services\Actuality;

use MMC\FestivalBundle\Entity\Actuality;
use MMC\FestivalBundle\Model\LinkTarget;
use MMC\FestivalBundle\Services\Lister\ListerRepository;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakeActualityRepository implements ListerRepository
{
    protected $actualities;

    protected $resolver;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->actualities = [];

        return $this;
    }

    public function findAll()
    {
        return $this->actualities;
    }

    public function addSereval($options)
    {
        foreach ($options as $option) {
            $this->add($option);
        }

        return $this;
    }

    public function add($options)
    {
        $options = $this->getOptionsResolver()->resolve($options);

        $actuality = new Actuality();
        $actuality->setTitle($options['title'])
            ->setContents($options['contents'])
            ->setPublishedAt($options['publishedAt'])
            ->setIllustration($options['illustration'])
            ->setAlt($options['alt'])
            ->setLink($options['link'])
            ->setTarget($options['target']);

        $this->actualities[] = $actuality;

        return $this;
    }

    protected function getOptionsResolver()
    {
        if ($this->resolver === null) {
            $this->resolver = new OptionsResolver();
            $this->resolver->setRequired([
                'title',
                'contents',
                'publishedAt',
                'illustration',
                'link',
                ]);
            $this->resolver->setDefaults([
                'alt' => null,
                'target' => '_self',
                ]);

            $this->resolver->setAllowedTypes('title', 'string');
            $this->resolver->setAllowedTypes('contents', 'string');
            $this->resolver->setAllowedTypes('publishedAt', ['integer', 'string']);
            $this->resolver->setAllowedTypes('illustration', 'string');
            $this->resolver->setAllowedTypes('alt', 'string');
            $this->resolver->setAllowedTypes('link', 'string');
            $this->resolver->setAllowedValues('target', LinkTarget::getKeys('strtolower'));

            $this->resolver->setNormalizer('target', function (Options $options, $value) {
                if ($value) {
                    $targets = LinkTarget::getConstants('strtolower');

                    return $targets[$value];
                }

                return $value;
            });

            $this->resolver->setNormalizer('publishedAt', function (Options $options, $value) {
                if ($value) {
                    $date = is_string($value) ? strtotime($value) : $value;

                    return \Datetime::createFromFormat('U', $date);
                }

                return;
            });
        }

        return $this->resolver;
    }
}
