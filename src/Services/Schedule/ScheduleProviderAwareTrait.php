<?php

namespace MMC\FestivalBundle\Services\Schedule;

trait ScheduleProviderAwareTrait
{
    protected $scheduleProvider;

    /**
     * @return ScheduleProviderInterface
     */
    public function getScheduleProvider()
    {
        return $this->scheduleProvider;
    }

    /**
     * @param ScheduleProviderInterface $scheduleProvider
     */
    public function setScheduleProvider($scheduleProvider)
    {
        $this->scheduleProvider = $scheduleProvider;

        return $this;
    }
}
