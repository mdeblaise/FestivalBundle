<?php

namespace MMC\FestivalBundle\Entity;

interface ExponentViews
{
    public function getId();

    public function getName();

    public function getDescriptif();

    public function getWebsite();

    public function getVignette();

    public function getAlt();

    public function getEmail();

    public function getStand();

    public function getLevel();

    public function getUnivers();

    public function getEdition();
}
