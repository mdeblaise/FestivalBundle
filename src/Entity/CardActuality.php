<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MMC\CardBundle\Entity\AbstractCard;

/**
 * @ORM\Entity
 * @ORM\Table(name="CardActuality")
 */
class CardActuality extends AbstractCard implements ActualityViews
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
     * @ORM\OneToMany(targetEntity="MMC\FestivalBundle\Entity\Actuality",
     *      mappedBy="card", cascade={"persist", "remove"})
     */
    protected $items;

    public function getId()
    {
        return $this->id;
    }

    public function getSupportedClass()
    {
        return Actuality::class;
    }

    public function getTitle()
    {
        return $this->getActiveView() ? $this->getActiveView()->getTitle() : '';
    }

    public function getContents()
    {
        return $this->getActiveView() ? $this->getActiveView()->getContents() : '';
    }

    public function getPublishedAt()
    {
        return $this->getActiveView() ? $this->getActiveView()->getPublishedAt() : null;
    }

    public function getIllustration()
    {
        return $this->getActiveView() ? $this->getActiveView()->getIllustration() : null;
    }

    public function getAlt()
    {
        return $this->getActiveView() ? $this->getActiveView()->getAlt() : null;
    }

    public function getLink()
    {
        return $this->getActiveView() ? $this->getActiveView()->getLink() : null;
    }

    public function getTarget()
    {
        return $this->getActiveView() ? $this->getActiveView()->getTarget() : null;
    }

    public function __toString()
    {
        return $this->getDraft() ? $this->getDraft()->getTitle() : $this->getTitle();
    }
}
