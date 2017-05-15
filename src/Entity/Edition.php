<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="edition")
 * @UniqueEntity("name")
 */
class Edition
{
    /*
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $referenceDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $festivalLength;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $preparationLength;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $current = false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active = false;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return date
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * @param date $referenceDate
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getFestivalLength()
    {
        return $this->festivalLength;
    }

    /**
     * @param int $festivalLength
     */
    public function setFestivalLength($festivalLength)
    {
        $this->festivalLength = $festivalLength;

        return $this;
    }

    /**
     * @return int
     */
    public function getPreparationLength()
    {
        return $this->preparationLength;
    }

    /**
     * @param int $preparationLength
     */
    public function setPreparationLength($preparationLength)
    {
        $this->preparationLength = $preparationLength;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param bool $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : '';
    }
}
