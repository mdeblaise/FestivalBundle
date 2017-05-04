<?php

namespace MMC\FestivalBundle\Services\Lister;

interface Request
{
    public function getStatus();

    public function getMaxPerPage();

    public function getCurrentPage();
}
