<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use MMC\CardBundle\Entity\AbstractCardItem;
use MMC\FestivalBundle\Validator\Constraint\Univers as AssertUnivers;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="exponent")
 * @Gedmo\Uploadable(path="uploads/exponents", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000")
 */
class Exponent extends AbstractCardItem implements ExponentViews
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
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\CardExponent",
     *      inversedBy="items", cascade={"persist", "remove"})
     *  @ORM\JoinColumn(nullable=false)
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=40)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(groups={"with_photo"})
     * @Assert\Length(max=135)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath
     * @Assert\Length(max=255)
     */
    private $vignette;

    /**
     * Temporary attributes to upload file.
     */
    private $file;

    /**
     * Temporary attributes to remove uploaded file.
     */
    private $removeFile = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     */
    private $stand;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=3))
     * @AssertUnivers()
     * @Assert\NotBlank()
     */
    private $univers;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(max=25)
     */
    protected $edition;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    public function getVignette()
    {
        return $this->vignette;
    }

    public function setVignette($vignette)
    {
        $this->vignette = $vignette;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getRemoveFile()
    {
        return $this->removeFile;
    }

    /**
     * @param UploadedFile $file
     */
    public function setRemoveFile($removeFile)
    {
        $this->removeFile = $removeFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getStand()
    {
        return $this->stand;
    }

    public function setStand($stand)
    {
        $this->stand = $stand;

        return $this;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    public function getUnivers()
    {
        return $this->univers;
    }

    public function setUnivers($univers)
    {
        $this->univers = $univers;

        return $this;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    public function duplicate()
    {
        $exponent = new self();
        $exponent->setCard($this->card)
            ->setName($this->name)
            ->setDescriptif($this->descriptif)
            ->setWebsite($this->website)
            ->setVignette($this->vignette)
            ->setAlt($this->alt)
            ->setEmail($this->email)
            ->setStand($this->stand)
            ->setLevel($this->level)
            ->setUnivers($this->univers)
            ->setEdition($this->edition)
            ;

        return $exponent;
    }

    public function getSupportedCardClass()
    {
        return CardExponent::class;
    }

    public function activeView($option = [])
    {
    }

    public function getValidationGroups()
    {
        $groups = parent::getValidationGroups();

        if ($this->getVignette()) {
            $groups = array_merge(parent::getValidationGroups(), ['with_photo']);
        }

        return $groups;
    }
}
