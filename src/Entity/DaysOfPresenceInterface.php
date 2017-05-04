<?php

namespace MMC\FestivalBundle\Entity;

interface DaysOfPresenceInterface
{
    public function getThisFriday();

    public function getThisSaturday();

    public function getThisSunday();
}
