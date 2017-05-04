<?php

namespace MMC\FestivalBundle\Services\Lister;

interface ListerRepository
{
    public function reset();

    public function findAll();

    public function addSereval($options);

    public function add($options);
}
