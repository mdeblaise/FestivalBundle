<?php

namespace MMC\FestivalBundle\Services\Schedule;

use MMC\FestivalBundle\Services\Edition\EditionProviderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ScheduleProvider
{
    protected $referenceDate;

    protected $festivalLength;

    protected $preparationLength;

    protected $translator;

    protected $editionProdiver;

    public function __construct(
        EditionProviderInterface $editionProdiver,
        TranslatorInterface $translator
    ) {
        $currentEdition = $editionProdiver->getCurrentEdition();
        $this->referenceDate = $currentEdition->getReferenceDate();
        $this->festivalLength = $currentEdition->getFestivalLength();
        $this->preparationLength = $currentEdition->getPreparationLength();
        $this->translator = $translator;
    }

    public function getDays()
    {
        $days = [];

        for ($i = 0; $i < $this->festivalLength; ++$i) {
            $day = new Day((clone $this->referenceDate)->modify('+'.$i.' days'));
            $days[$day->getCode()] = $day;
        }

        return $days;
    }

    public function getDaysCode()
    {
        return $this->translateDays($this->getDays());
    }

    public function getStaffDays()
    {
        $days = [];

        for ($i = $this->preparationLength; $i > 0; --$i) {
            $day = new Day((clone $this->referenceDate)->modify('-'.$i.' days'));
            $days[$day->getCode()] = $day;
        }

        return array_merge($days, $this->getdays());
    }

    public function getStaffDaysCode()
    {
        return $this->translateDays($this->getStaffDays());
    }

    public function getStaffTimeSlots()
    {
        $timeSlots = [];

        foreach ($this->getStaffDays() as $day) {
            $ts = new TimeSlot($day->getDate(), 'am');
            $timeSlots[$ts->getCode()] = $ts;
            $ts = new TimeSlot($day->getDate(), 'pm');
            $timeSlots[$ts->getCode()] = $ts;
        }

        return $timeSlots;
    }

    protected function translateDays($days)
    {
        $translatedDays = [];
        foreach ($days as $day) {
            $translatedDays[$day->getCode()] = strtolower($this->translator->trans($day->getDay(), [], 'schedule'));
        }

        return $translatedDays;
    }
}
