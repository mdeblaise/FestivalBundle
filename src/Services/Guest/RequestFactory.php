<?php

namespace MMC\FestivalBundle\Services\Guest;

use MMC\FestivalBundle\Model\Status;
use MMC\FestivalBundle\Services\Edition\EditionProviderInterface;
use MMC\FestivalBundle\Services\EnumUniversProviderAwareTrait;
use MMC\FestivalBundle\Services\Schedule\ScheduleProviderAwareTrait;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestFactory
{
    use EnumUniversProviderAwareTrait;
    use ScheduleProviderAwareTrait;

    protected $maxPerPage;

    protected $edition;

    public function __construct($maxPerPage, EditionProviderInterface $editionProdiver)
    {
        $this->maxPerPage = $maxPerPage;
        $this->editionProdiver = $editionProdiver;
    }

    public function create($options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'admin' => false,
            'univers' => null,
            'day' => null,
            'honor' => false,
            'page' => 1,
        ]);

        $resolver->setAllowedTypes('admin', 'boolean');
        $resolver->setAllowedTypes('univers', ['null', 'string']);
        $resolver->setAllowedTypes('day', ['null', 'string']);
        $resolver->setAllowedTypes('honor', 'boolean');
        $resolver->setAllowedTypes('page', ['string', 'integer']);

        $resolver->setAllowedValues('univers', array_merge([null], $this->getEnumUniversProvider()->getCodes()));
        $resolver->setAllowedValues('day', array_merge([null], $this->getScheduleProvider()->getDaysCode()));

        $resolver->setNormalizer('univers', function (Options $options, $value) {
            if ($value) {
                $univers = $this->getEnumUniversProvider()->getValues();

                return $univers[$value];
            }

            return $value;
        });

        $options = $resolver->resolve($options);

        $request = new Request();

        if ($options['day']) {
            switch ($options['day']) {
                case 'vendredi':
                    $request->setThisFriday(true);
                    break;
                case 'samedi':
                    $request->setThisSaturday(true);
                    break;
                case 'dimanche':
                    $request->setThisSunday(true);
                    break;
            }
        }

        $request->setMaxPerPage($this->maxPerPage);
        $request->setEdition($this->editionProdiver->getCurrentEdition());
        $request->setStatus($options['admin'] ? [Status::VALID, Status::DRAFT, Status::CREATING] : [Status::VALID]);
        $request->setUnivers($options['univers']);
        $request->setGuestOfHonor($options['honor']);
        $request->setCurrentPage($options['page']);

        return $request;
    }
}
