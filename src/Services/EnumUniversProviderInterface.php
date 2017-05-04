<?php

namespace MMC\FestivalBundle\Services;

interface EnumUniversProviderInterface
{
    public function getClassname();

    public function getCodes();

    public function getValues();
}
