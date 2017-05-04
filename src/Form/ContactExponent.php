<?php

namespace MMC\FestivalBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class ContactExponent
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
    protected $email;

    /**
     * @Assert\Regex(pattern="/^((\+[0-9]{11})|(0[0-9]{9}))$/")
     */
    protected $phone;

    protected $socialReason;

    protected $typeProducts;

    protected $message;

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
    public function getSocialReason()
    {
        return $this->socialReason;
    }

    /**
     * @param string $socialReason
     */
    public function setSocialReason($socialReason)
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    /**
     * @return string
     */
    public function getTypeProducts()
    {
        return $this->typeProducts;
    }

    /**
     * @param string $typeProducts
     */
    public function setTypeProducts($typeProducts)
    {
        $this->typeProducts = $typeProducts;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
