<?php

namespace MMC\FestivalBundle\Services\Schedule;

class TimeSlot extends Day
{
    protected $part;

    public function __construct(
        \Datetime $date,
        $part
    ) {
        parent::__construct($date);

        $this->part = $part;
    }

    /**
     * @return string
     */
    public function getPart()
    {
        return $this->part;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return parent::getCode().'_'.$this->part;
    }
}
