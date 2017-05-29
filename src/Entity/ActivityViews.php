<?php

namespace MMC\FestivalBundle\Entity;

interface ActivityViews
{
    public function getId();

    public function getTitle();

    public function getDescriptif();

    public function getVignette();

    public function getAltVignette();

    public function getCoverPhoto();

    public function getAltCoverPhoto();

    public function getType();

    public function getUnivers();

    public function getParticipations();
}
