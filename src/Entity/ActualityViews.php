<?php

namespace MMC\FestivalBundle\Entity;

interface ActualityViews
{
    public function getId();

    public function getTitle();

    public function getContents();

    public function getPublishedAt();

    public function getIllustration();

    public function getAlt();

    public function getLink();

    public function getTarget();
}
