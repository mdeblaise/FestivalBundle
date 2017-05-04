<?php

namespace MMC\FestivalBundle\Model;

use Greg0ire\Enum\AbstractEnum;

final class ActivityType extends AbstractEnum
{
    const CONFERENCE = 'conf';
    const DEDICATION = 'dedi';
    const EXPOSURE = 'expo';
    const SHOW = 'show';
    const WORKSHOP = 'work';
}
