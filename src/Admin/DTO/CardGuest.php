<?php

namespace MMC\FestivalBundle\Admin\DTO;

use MMC\CardBundle\Admin\DTO\Card;

class CardGuest extends Card
{
    protected $name;

    protected $externalLink;

    protected $univers;

    protected $guestOfHonor;

    protected $thisFriday;

    protected $thisSaturday;

    protected $thisSunday;

    protected $vignette;

    protected $editionName;

    public function __construct(
        $id,
        $uuid,
        $status,
        $isDraft,
        $name,
        $externalLink,
        $univers,
        $guestOfHonor,
        $thisFriday,
        $thisSaturday,
        $thisSunday,
        $vignette,
        $altVignette,
        $coverPhoto,
        $altCoverPhoto,
        $editionName
    ) {
        parent::__construct($id, $uuid, $status, $isDraft);

        $this->name = $name;
        $this->externalLink = $externalLink;
        $this->univers = $univers;
        $this->guestOfHonor = $guestOfHonor;
        $this->thisFriday = $thisFriday;
        $this->thisSaturday = $thisSaturday;
        $this->thisSunday = $thisSunday;
        $this->vignette = $vignette;
        $this->altVignette = $altVignette;
        $this->coverPhoto = $coverPhoto;
        $this->altCoverPhoto = $altCoverPhoto;
        $this->editionName = $editionName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getExternalLink()
    {
        return $this->externalLink;
    }

    /**
     * @return string
     */
    public function getUnivers()
    {
        return $this->univers;
    }

    /**
     * @return bool
     */
    public function getGuestOfHonor()
    {
        return $this->guestOfHonor;
    }

    /**
     * @return bool
     */
    public function getThisFriday()
    {
        return $this->thisFriday;
    }

    /**
     * @return bool
     */
    public function getThisSaturday()
    {
        return $this->thisSaturday;
    }

    /**
     * @return bool
     */
    public function getThisSunday()
    {
        return $this->thisSunday;
    }

    /**
     * @return string
     */
    public function getVignette()
    {
        return $this->vignette;
    }

    /**
     * @return string
     */
    public function getAltVignette()
    {
        return $this->altVignette;
    }

    /**
     * @return string
     */
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    /**
     * @return string
     */
    public function getAltCoverPhoto()
    {
        return $this->altCoverPhoto;
    }

    /**
     * @return string
     */
    public function getEditionName()
    {
        return $this->editionName;
    }
}
