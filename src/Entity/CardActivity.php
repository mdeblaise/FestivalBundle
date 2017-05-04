<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MMC\CardBundle\Entity\AbstractCard;

/**
 * @ORM\Entity
 * @ORM\Table(name="CardActivity")
 */
class CardActivity extends AbstractCard implements ActivityViews
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(type="uuid")
     */
    protected $uuid;

    /**
     * @ORM\OneToMany(targetEntity="MMC\FestivalBundle\Entity\Activity",
     *      mappedBy="card", cascade={"persist", "remove"})
     */
    protected $items;

    public function getId()
    {
        return $this->id;
    }

    public function getSupportedClass()
    {
        return Activity::class;
    }

    public function getTitle()
    {
        return $this->getActiveView() ? $this->getActiveView()->getTitle() : '';
    }

    public function getDescriptif()
    {
        return $this->getActiveView() ? $this->getActiveView()->getDescriptif() : '';
    }

    public function getVignette()
    {
        return $this->getActiveView() ? $this->getActiveView()->getVignette() : '';
    }

    public function getAltVignette()
    {
        return $this->getActiveView() ? $this->getActiveView()->getAltVignette() : '';
    }

    public function getCoverPhoto()
    {
        return $this->getActiveView() ? $this->getActiveView()->getCoverPhoto() : '';
    }

    public function getAltCoverPhoto()
    {
        return $this->getActiveView() ? $this->getActiveView()->getAltCoverPhoto() : '';
    }

    public function getType()
    {
        return $this->getActiveView() ? $this->getActiveView()->getType() : null;
    }

    public function getUnivers()
    {
        return $this->getActiveView() ? $this->getActiveView()->getUnivers() : null;
    }

    public function getParticipations()
    {
        return $this->getActiveView() ? $this->getActiveView()->getParticipations() : null;
    }

    public function getEdition()
    {
        return $this->getActiveView() ? $this->getActiveView()->getEdition() : '';
    }

    public function __toString()
    {
        return $this->getDraft() ? $this->getDraft()->getTitle() : $this->getTitle();
    }
}
