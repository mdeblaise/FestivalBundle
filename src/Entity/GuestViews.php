<?php

namespace MMC\FestivalBundle\Entity;

interface GuestViews
{
    public function getId();

    public function getName();

    public function getExternalLink();

    public function getVignette();

    public function getCoverPhoto();

    public function getBiography();

    public function getGuestOfHonor();

    public function getThisFriday();

    public function getThisSaturday();

    public function getThisSunday();

    public function getUnivers();

    public function getParticipations();

    public function getEdition();
}
