<?php

namespace MMC\FestivalBundle\Services;

class DateReference
{
    public $date;

    public function __construct()
    {
        $this->reset();
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function reset()
    {
        $this->date = new \Datetime('now');
    }
}
