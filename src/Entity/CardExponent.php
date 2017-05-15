<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MMC\CardBundle\Entity\AbstractCard;

/**
 * @ORM\Entity
 * @ORM\Table(name="CardExponent")
 */
class CardExponent extends AbstractCard
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
     * @ORM\OneToMany(targetEntity="MMC\FestivalBundle\Entity\Exponent",
     *      mappedBy="card", cascade={"persist", "remove"})
     */
    protected $items;

    /**
     * @ORM\OneToOne(targetEntity="MMC\FestivalBundle\Entity\ContactExponent", mappedBy="exponent")
     */
    protected $contactExponent;

    public function getId()
    {
        return $this->id;
    }

    public function getSupportedClass()
    {
        return Exponent::class;
    }

    public function getName()
    {
        return $this->getActiveView() ? $this->getActiveView()->getName() : '';
    }

    public function getDescriptif()
    {
        return $this->getActiveView() ? $this->getActiveView()->getDescriptif() : '';
    }

    public function getWebsite()
    {
        return $this->getActiveView() ? $this->getActiveView()->getWebsite() : '';
    }

    public function getVignette()
    {
        return $this->getActiveView() ? $this->getActiveView()->getVignette() : '';
    }

    public function getAlt()
    {
        return $this->getActiveView() ? $this->getActiveView()->getAlt() : null;
    }

    public function getEmail()
    {
        return $this->getActiveView() ? $this->getActiveView()->getEmail() : '';
    }

    public function getStand()
    {
        return $this->getActiveView() ? $this->getActiveView()->getStand() : '';
    }

    public function getLevel()
    {
        return $this->getActiveView() ? $this->getActiveView()->getLevel() : '';
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

    /**
     * @return MMC\FestivalBundle\ContactExponent
     */
    public function getContactExponent()
    {
        return $this->contactExponent;
    }

    /**
     * @param MMC\FestivalBundle\ContactExponent $contactExponent
     */
    public function setContactExponent($contactExponent)
    {
        $this->contactExponent = $contactExponent;

        return $this;
    }
}
