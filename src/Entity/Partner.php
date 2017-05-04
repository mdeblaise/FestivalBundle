<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use MMC\FestivalBundle\Services\Carousel\CarouselImageViewInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="partner")
 * @Gedmo\Uploadable(path="uploads/partners", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000")
 */
class Partner implements CarouselImageViewInterface
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
     * @ORM\Column(type="string", length=100))
     * @Assert\NotBlank()
     * @Assert\Length(max=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Gedmo\UploadableFilePath
     * @Assert\Length(max=255)
     */
    protected $logo;

    /**
     * Temporary attributes to upload file.
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;

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

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

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

    public function getSrc()
    {
        return  $this->logo;
    }

    public function getTitle()
    {
        return  $this->name;
    }

    public function getCaption()
    {
        return  $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
