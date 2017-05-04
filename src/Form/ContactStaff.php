<?php

namespace MMC\FestivalBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class ContactStaff
{
    /**
     * @Assert\NotBlank()
     */
    protected $firstname;

    /**
     * @Assert\NotBlank()
     */
    protected $lastname;

    /**
     * @Assert\NotBlank()
     */
    protected $birthday;

    /**
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @Assert\Regex(pattern="/^((\+[0-9]{11})|(0[0-9]{9}))$/")
     */
    protected $phone;

    /**
     * @Assert\NotBlank(message="univers_have_to_be_set")
     */
    protected $univers;

    /**
     * @Assert\NotBlank()
     */
    protected $whyWishYouJoin;

    /**
     * @Assert\NotBlank()
     */
    protected $whatDoYouLikeToDo;

    /**
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
}
