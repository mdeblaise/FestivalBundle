<?php

namespace MMC\FestivalBundle\Services\Schedule;

class Day
{
    protected $date;

    public function __construct(
        \Datetime $date
    ) {
        $this->date = clone $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDay()
    {
        return $this->date->format('D');
    }

    public function getCode()
    {
        return $this->date->format('D_d');
    }

    public function getNumber()
    {
        return $this->date->format('d');
    }
}
