<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Greg0ire\Enum\Bridge\Symfony\Validator\Constraint\Enum;
use MMC\CardBundle\Entity\AbstractCardItem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="actuality")
 * @Gedmo\Uploadable(path="uploads/actualities", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000")
 */
class Actuality extends AbstractCardItem implements ActualityViews
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
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\CardActuality",
     *      inversedBy="items", cascade={"persist", "remove"})
     *  @ORM\JoinColumn(nullable=false)
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=26)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=141, nullable=true)
     * @Assert\Length(max=70)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $contents;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath
     * @Assert\Length(max=255)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $illustration;

    /**
     * Temporary attributes to upload file.
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=2)
     * @Enum("MMC\FestivalBundle\Model\LinkTarget")
     * @Assert\Length(max=2)
     * @Assert\NotBlank()
     */
    private $target;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $status;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\Datetime $publishedAt = null)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getIllustration()
    {
        return $this->illustration;
    }

    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;

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

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    public function duplicate()
    {
        $actuality = new self();
        $actuality->setCard($this->card)
                ->setTitle($this->title)
                ->setContents($this->contents)
                ->setPublishedAt($this->publishedAt)
                ->setIllustration($this->illustration)
                ->setAlt($this->alt)
                ->setLink($this->link)
                ->setTarget($this->target)
                ;

        return $actuality;
    }

    public function getSupportedCardClass()
    {
        return CardActuality::class;
    }

    public function activeView($option = [])
    {
    }
}
