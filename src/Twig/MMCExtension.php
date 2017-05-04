<?php

namespace MMC\FestivalBundle\Twig;

use Greg0ire\Enum\Bridge\Twig\Extension\EnumExtension;
use MMC\FestivalBundle\Entity\DaysOfPresenceInterface;
use MMC\FestivalBundle\Services\Carousel\Carousel;
use MMC\FestivalBundle\Services\CurrentPageInfo;
use MMC\FestivalBundle\Services\EnumUniversProviderInterface;
use MMC\FestivalBundle\Services\Schedule\ScheduleProvider;
use Symfony\Component\Translation\TranslatorInterface;

class MMCExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    protected $currentPageInfo;

    protected $carousel;

    protected $translator;

    protected $altText;

    protected $enumUniversProvider;

    protected $enumExtension;

    protected $resourcesPath;

    public function __construct(
        CurrentPageInfo $currentPageInfo,
        Carousel $carousel,
        TranslatorInterface $translator,
        $altText,
        EnumUniversProviderInterface $enumUniversProvider,
        EnumExtension $enumExtension,
        ScheduleProvider $scheduleProvider,
        $resourcesPath
    ) {
        $this->currentPageInfo = $currentPageInfo;
        $this->carousel = $carousel;
        $this->translator = $translator;
        $this->altText = $altText;
        $this->enumUniversProvider = $enumUniversProvider;
        $this->enumExtension = $enumExtension;
        $this->scheduleProvider = $scheduleProvider;
        $this->resourcesPath = $resourcesPath;
    }

    public function getGlobals()
    {
        return [
            'currentPage' => $this->currentPageInfo,
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('renderCarousel', [$this, 'renderCarousel'], [
                'is_safe' => ['html'],
                'needs_environment' => true,
                ]),
            new \Twig_SimpleFunction('getAlt', [$this, 'getAlt']),
            new \Twig_SimpleFunction('formatDays', [$this, 'formatDays'], [
                'is_safe' => ['html'],
                ]),
            new \Twig_SimpleFunction('universFlagColor', [$this, 'universFlagColor'], [
                'is_safe' => ['html'],
                ]),
            new \Twig_SimpleFunction('getUniversCodes', [$this, 'universCodes']),
            new \Twig_SimpleFunction('getDays', [$this, 'getDays']),
            new \Twig_SimpleFunction('getStaffDays', [$this, 'getStaffDays']),
            new \Twig_SimpleFunction('getResourcesPath', [$this, 'getResourcesPath']),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('decode_entities', function ($string) {
                return html_entity_decode($string);
            }),
            new \Twig_SimpleFilter('univers_label', [$this, 'universLabel']),
        ];
    }

    public function getTests()
    {
        return [
            new \Twig_SimpleTest('present', [$this, 'testPresent']),
        ];
    }

    public function renderCarousel(\Twig_Environment $twig, $name, $options = [])
    {
        $carouselView = $this->carousel->getView($name);

        if (!$carouselView) {
            return;
        }

        $carouselView->setOptions($options);

        return $twig->render('MMCFestivalBundle:Default:carousel.html.twig', compact([
            'carouselView',
            ]));
    }

    public function getName()
    {
        return 'jtf_extension';
    }

    public function getAlt($prefixAlt)
    {
        return trim($prefixAlt.' '.$this->altText);
    }

    public function testPresent(DaysOfPresenceInterface $item)
    {
        return $item->getThisFriday() || $item->getThisSaturday() || $item->getThisSunday();
    }

    public function formatDays(DaysOfPresenceInterface $item, $long = false)
    {
        $texts = [];

        $i = 0;
        if ($item->getThisFriday()) {
            ++$i;
            $texts['%short-'.$i.'%'] = $this->translator->trans('friday.short', [], 'days');
            $texts['%long-'.$i.'%'] = $this->translator->trans('friday.long', [], 'days');
        }

        if ($item->getThisSaturday()) {
            ++$i;
            $texts['%short-'.$i.'%'] = $this->translator->trans('saturday.short', [], 'days');
            $texts['%long-'.$i.'%'] = $this->translator->trans('saturday.long', [], 'days');
        }

        if ($item->getThisSunday()) {
            ++$i;
            $texts['%short-'.$i.'%'] = $this->translator->trans('sunday.short', [], 'days');
            $texts['%long-'.$i.'%'] = $this->translator->trans('sunday.long', [], 'days');
        }

        return $this->translator->transChoice('format.'.($long ? 'long' : 'short'), $i, $texts, 'days');
    }

    public function universFlagColor($univers)
    {
        return 'flag flag-'.$univers;
    }

    public function universLabel($univers)
    {
        return $this->enumExtension->label($univers, $this->enumUniversProvider->getClassname(), 'Univers', false);
    }

    public function universCodes()
    {
        return $this->enumUniversProvider->getCodes();
    }

    public function getDays()
    {
        return $this->scheduleProvider->getDays();
    }

    public function getStaffDays()
    {
        return $this->scheduleProvider->getStaffDays();
    }

    public function getResourcesPath($key)
    {
        return isset($this->resourcesPath[$key]) ? $this->resourcesPath[$key] : null;
    }
}
