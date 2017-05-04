<?php

namespace MMC\FestivalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use MMC\CardBundle\Entity\AbstractCardItem;
use MMC\FestivalBundle\Model\ActivityType;
use MMC\FestivalBundle\Validator\Constraint\Univers as AssertUnivers;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="activity")
 * @Gedmo\Uploadables(configurations={
 *   @Gedmo\Uploadable(identifier="thumb", path="uploads/activities/thumb", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000"),
 *   @Gedmo\Uploadable(identifier="cover", path="uploads/activities/cover", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000")
 * })
 */
class Activity extends AbstractCardItem implements ActivityViews, DaysOfPresenceInterface
{
    /*
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    use DaysOfPresenceTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\CardActivity",
     *      inversedBy="items", cascade={"persist", "remove"})
     *  @ORM\JoinColumn(nullable=false)
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath(identifier="thumb")
     * @Assert\Length(max=255)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $vignette;

    /*
     * Temporary attributes to upload file.
     */
    private $fileThumb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $altVignette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath(identifier="cover")
     * @Assert\Length(max=255)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $coverPhoto;

    /*
     * Temporary attributes to upload file.
     */
    private $fileCover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $altCoverPhoto;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank()
     * @Assert\Length(max=4)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=3))
     * @AssertUnivers()
     * @Assert\NotBlank()
     */
    private $univers;

    /**
     * @ORM\ManyToMany(targetEntity="MMC\FestivalBundle\Entity\CardGuest",
     *      inversedBy="participations", cascade={"persist", "remove"})
     */
    protected $participations;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(max=25)
     */
    protected $edition;

    public function __construct()
    {
        $this->participations = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

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
    public function getFileThumb()
    {
        return $this->fileThumb;
    }

    /**
     * @param UploadedFile $fileThumb
     */
    public function setFileThumb($fileThumb)
    {
        $this->fileThumb = $fileThumb;

        return $this;
    }

    /**
     * @return string
     */
    public function getAltVignette()
    {
        return $this->altVignette;
    }

    /**
     * @param string $altVignette
     */
    public function setAltVignette($altVignette)
    {
        $this->altVignette = $altVignette;

        return $this;
    }

    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    public function setCoverPhoto($coverPhoto)
    {
        $this->coverPhoto = $coverPhoto;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFileCover()
    {
        return $this->fileCover;
    }

    /**
     * @param UploadedFile $fileCover
     */
    public function setFileCover($fileCover)
    {
        $this->fileCover = $fileCover;

        return $this;
    }

    /**
     * @return string
     */
    public function getAltCoverPhoto()
    {
        return $this->altCoverPhoto;
    }

    /**
     * @param string $alt
     */
    public function setAltCoverPhoto($altCoverPhoto)
    {
        $this->altCoverPhoto = $altCoverPhoto;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (ActivityType::isValidValue($type)) {
            $this->type = $type;
        }

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
    /**
     * @return ArrayCollection
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * @param ArrayCollection $participations
     */
    public function setParticipations($participations)
    {
        $this->participations = $participations;

        return $this;
    }

    public function getValidParticipations()
    {
        $participations = $this->participations->toArray();

        $participations = array_filter($participations, function ($p) {
            return $p->getValid();
        });

        return $participations;
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
        $activity = new self();
        $activity->setCard($this->card)
            ->setTitle($this->title)
            ->setDescriptif($this->descriptif)
            ->setVignette($this->vignette)
            ->setAltVignette($this->altVignette)
            ->setCoverPhoto($this->coverPhoto)
            ->setAltCoverPhoto($this->altCoverPhoto)
            ->setType($this->type)
            ->setUnivers($this->univers)
            ->setThisFriday($this->thisFriday)
            ->setThisSaturday($this->thisSaturday)
            ->setThisSunday($this->thisSunday)
            ->setParticipations($this->participations)
            ->setEdition($this->edition)
            ;

        return $activity;
    }

    public function getSupportedCardClass()
    {
        return CardActivity::class;
    }

    public function activeView($option = [])
    {
    }
}
