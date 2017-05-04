<?php

namespace MMC\FestivalBundle\Model;

use Greg0ire\Enum\AbstractEnum;

final class LinkTarget extends AbstractEnum
{
    const _SELF = 's';
    const BLANK = 'b';
    const MODAL_REMOTE = 'mr';
    const MODAL_IMG = 'mi';
}
