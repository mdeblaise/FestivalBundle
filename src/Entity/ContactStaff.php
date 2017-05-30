<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="contactStaff")
 */
class ContactStaff
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
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^((\+[0-9]{11})|(0[0-9]{9}))$/")
     */
    protected $phone;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $birthday;

    /**
     * @ORM\Column(type="array"))
     * @Assert\NotBlank()
     */
    protected $univers;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $whyWishYouJoin;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $whatDoYouLikeToDo;

    /**
     * @ORM\Column(type="array")
     * @Assert\NotBlank(message="availabilities_have_to_be_set")
     */
    protected $availabilities;

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
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return array
     */
    public function getUnivers()
    {
        return $this->univers;
    }

    /**
     * @param array $univers
     */
    public function setUnivers($univers)
    {
        $this->univers = $univers;

        return $this;
    }

    /**
     * @return string
     */
    public function getWhyWishYouJoin()
    {
        return $this->whyWishYouJoin;
    }

    /**
     * @param string $whyWishYouJoin
     */
    public function setWhyWishYouJoin($whyWishYouJoin)
    {
        $this->whyWishYouJoin = $whyWishYouJoin;

        return $this;
    }

    /**
     * @return string
     */
    public function getWhatDoYouLikeToDo()
    {
        return $this->whatDoYouLikeToDo;
    }

    /**
     * @param string $whatDoYouLikeToDo
     */
    public function setWhatDoYouLikeToDo($whatDoYouLikeToDo)
    {
        $this->whatDoYouLikeToDo = $whatDoYouLikeToDo;

        return $this;
    }

    /**
     * @return array
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
    }

    /**
     * @param array $availabilities
     */
    public function setAvailabilities($availabilities)
    {
        $this->availabilities = $availabilities;

        return $this;
    }

    public function __toString()
    {
        return $this->getLastname().' '.$this->getFirstname();
    }
}
