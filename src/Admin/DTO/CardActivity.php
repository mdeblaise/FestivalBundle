<?php

namespace MMC\FestivalBundle\Admin\DTO;

use MMC\CardBundle\Admin\DTO\Card;

class CardActivity extends Card
{
    protected $title;

    protected $type;

    protected $univers;

    protected $vignette;

    protected $altVignette;

    protected $coverPhoto;

    protected $altCoverPhoto;

    protected $editionName;

    public function __construct(
        $id,
        $uuid,
        $status,
        $isDraft,
        $title,
        $type,
        $univers,
        $vignette,
        $altVignette,
        $coverPhoto,
        $altCoverPhoto,
        $thisFriday,
        $thisSaturday,
        $thisSunday,
        $editionName
    ) {
        parent::__construct($id, $uuid, $status, $isDraft);

        $this->title = $title;
        $this->type = $type;
        $this->univers = $univers;
        $this->vignette = $vignette;
        $this->altVignette = $altVignette;
        $this->coverPhoto = $coverPhoto;
        $this->altCoverPhoto = $altCoverPhoto;
        $this->thisFriday = $thisFriday;
        $this->thisSaturday = $thisSaturday;
        $this->thisSunday = $thisSunday;
        $this->editionName = $editionName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUnivers()
    {
        return $this->univers;
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
     * @return type
     */
    public function getEditionName()
    {
        return $this->editionName;
    }
}
