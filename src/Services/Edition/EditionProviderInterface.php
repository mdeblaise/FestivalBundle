<?php

namespace MMC\FestivalBundle\Services\Edition;

interface EditionProviderInterface
{
    public function getCurrentEdition();

    public function getActiveEdition();
}
