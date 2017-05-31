<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="days_of_presence")
 */
class DaysOfPresence
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
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $dateOfPresence;

    /**
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\Edition")
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    protected $edition;

    /**
     * @ORM\ManyToMany(targetEntity="MMC\FestivalBundle\Entity\CardGuest",
     *      mappedBy="daysOfPresence", cascade={"persist", "remove"})
     */
    protected $guests;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return date
     */
    public function getDateOfPresence()
    {
        return $this->dateOfPresence;
    }

    /**
     * @param date $dateOfPresence
     */
    public function setDateOfPresence($dateOfPresence)
    {
        $this->dateOfPresence = $dateOfPresence;
        return $this;
    }

    /**
     * @return MMC\FestivalBundle\Entity\Edition
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param MMC\FestivalBundle\Entity\Edition $edition
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    public function __toString()
    {
        return $this->getDateOfPresence()->format('d-m-Y');
    }
}
