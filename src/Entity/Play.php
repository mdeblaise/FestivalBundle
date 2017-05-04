<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="play")
 * @UniqueEntity("email")
 */
class Play
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
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(max=2)
     */
    protected $departmentNumber;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     * @Assert\Length(max=10)
     */
    protected $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $receiveInformation;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getDepartmentNumber()
    {
        return $this->departmentNumber;
    }

    /**
     * @param string $postalCode
     */
    public function setDepartmentNumber($departmentNumber)
    {
        $this->departmentNumber = $departmentNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReceiveInformation()
    {
        return $this->receiveInformation;
    }

    /**
     * @param bool $receiveInformation
     */
    public function setReceiveInformation($receiveInformation)
    {
        $this->receiveInformation = $receiveInformation;

        return $this;
    }
}
