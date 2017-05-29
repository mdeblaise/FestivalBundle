<?php

namespace MMC\FestivalBundle\Admin\DTO;

use MMC\CardBundle\Admin\DTO\Card;

class CardExponent extends Card
{
    protected $name;

    protected $descriptif;

    protected $website;

    protected $email;

    protected $stand;

    protected $level;

    protected $vignette;

    protected $editionName;

    public function __construct(
        $id,
        $uuid,
        $status,
        $isDraft,
        $name,
        $descriptif,
        $website,
        $email,
        $stand,
        $level,
        $univers,
        $vignette,
        $alt,
        $editionName
    ) {
        parent::__construct($id, $uuid, $status, $isDraft);

        $this->name = $name;
        $this->descriptif = $descriptif;
        $this->website = $website;
        $this->email = $email;
        $this->stand = $stand;
        $this->level = $level;
        $this->univers = $univers;
        $this->vignette = $vignette;
        $this->alt = $alt;
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
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getStand()
    {
        return $this->stand;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
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
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return string
     */
    public function getEditionName()
    {
        return $this->editionName;
    }
}
