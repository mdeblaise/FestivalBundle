<?php

namespace MMC\FestivalBundle\Entity\Behavior;

interface RelatedEditionInterface
{
    public function getGlobalCode();

    public function getEdition();
}
