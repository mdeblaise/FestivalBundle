<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Greg0ire\Enum\Bridge\Symfony\Validator\Constraint\Enum;
use MMC\FestivalBundle\Model\Civility;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="getProgram")
 */
class GetProgram
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
     * @ORM\Column(type="string", length=4))
     * @Enum("MMC\FestivalBundle\Model\Civility")
     * @Assert\NotBlank()
     */
    protected $civility;

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
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     * @Assert\Length(max=10)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    protected $postalCode;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    protected $city;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $receiveInformation;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $notTransmitData;

    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param array $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
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
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;

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

    /**
     * @return bool
     */
    public function getNotTransmitData()
    {
        return $this->notTransmitData;
    }

    /**
     * @param bool $notTransmitData
     */
    public function setNotTransmitData($notTransmitData)
    {
        $this->notTransmitData = $notTransmitData;

        return $this;
    }
}
