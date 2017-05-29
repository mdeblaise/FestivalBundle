<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MMC\CardBundle\Entity\AbstractCard;
use MMC\FestivalBundle\Model\Status;
use MMC\FestivalBundle\Entity\Behavior\RelatedEditionInterface;
use MMC\FestivalBundle\Entity\Behavior\RelatedEditionTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="CardGuest")
 */
class CardGuest extends AbstractCard implements GuestViews, RelatedEditionInterface
{
    use RelatedEditionTrait;
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
     * @ORM\OneToMany(targetEntity="MMC\FestivalBundle\Entity\Guest",
     *      mappedBy="card", cascade={"persist", "remove"})
     */
    protected $items;

    /**
     * @ORM\ManyToMany(targetEntity="MMC\FestivalBundle\Entity\Activity",
     *      mappedBy="participations", cascade={"persist", "remove"})
     */
    protected $participations;

    public function __construct()
    {
        parent::__construct();

        $this->participations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSupportedClass()
    {
        return Guest::class;
    }

    /**
     * @return ArrayCollection
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * @param ArrayCollection $participations
     */
    public function setParticipations($participations)
    {
        $this->participations = $participations;

        return $this;
    }

    public function getValidParticipations()
    {
        $participations = $this->participations->toArray();

        $participations = array_filter($participations, function ($p) {
            return $p->getStatus() == Status::VALID;
        });

        return $participations;
    }

    public function getName()
    {
        return $this->getActiveView() ? $this->getActiveView()->getName() : '';
    }

    public function getExternalLink()
    {
        return $this->getActiveView() ? $this->getActiveView()->getExternalLink() : '';
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

    public function getBiography()
    {
        return $this->getActiveView() ? $this->getActiveView()->getBiography() : '';
    }

    public function getGuestOfHonor()
    {
        return $this->getActiveView() ? $this->getActiveView()->getGuestOfHonor() : false;
    }

    public function getThisFriday()
    {
        return $this->getActiveView() ? $this->getActiveView()->getThisFriday() : false;
    }

    public function getThisSaturday()
    {
        return $this->getActiveView() ? $this->getActiveView()->getThisSaturday() : false;
    }

    public function getThisSunday()
    {
        return $this->getActiveView() ? $this->getActiveView()->getThisSunday() : false;
    }

    public function getUnivers()
    {
        return $this->getActiveView() ? $this->getActiveView()->getUnivers() : null;
    }

    public function getEdition()
    {
        return $this->getActiveView() ? $this->getActiveView()->getEdition() : '';
    }

    public function __toString()
    {
        return $this->getDraft() ? $this->getDraft()->getName() : $this->getName();
    }
}
