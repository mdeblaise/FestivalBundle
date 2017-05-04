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
 * @ORM\Table(name="guest")
 * @Gedmo\Uploadables(configurations={
 *   @Gedmo\Uploadable(identifier="thumb", path="uploads/guests/thumb", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000"),
 *   @Gedmo\Uploadable(identifier="cover", path="uploads/guests/cover", allowOverwrite=true, filenameGenerator="SHA1",
 *     allowedTypes="image/png,image/jpeg,image/jpg,image/gif", maxSize="2000000"),
 * })
 */
class Guest extends AbstractCardItem implements GuestViews, DaysOfPresenceInterface
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
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\CardGuest",
     *      inversedBy="items", cascade={"persist", "remove"})
     *  @ORM\JoinColumn(nullable=false)
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $externalLink;

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

    /**
     * Temporary attributes to upload file.
     */
    private $fileCover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $altCoverPhoto;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(groups={"validate"})
     */
    private $biography;

    /**
     * @ORM\Column(type="boolean")
     */
    private $guestOfHonor;

    /**
     * @ORM\Column(type="string", length=3))
     * @AssertUnivers()
     * @Assert\NotBlank()
     */
    private $univers;

    /**
     * @ORM\Column(type="string", length=1))
     */
    protected $status;

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

    public function getExternalLink()
    {
        return $this->externalLink;
    }

    public function setExternalLink($externalLink)
    {
        $this->externalLink = $externalLink;

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

    public function getBiography()
    {
        return $this->biography;
    }

    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    public function getGuestOfHonor()
    {
        return $this->guestOfHonor;
    }

    public function setGuestOfHonor($guestOfHonor)
    {
        $this->guestOfHonor = $guestOfHonor;

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

    public function getParticipations()
    {
        return $this->getCard() ? $this->getCard()->getParticipations() : [];
    }

    public function getValidParticipations()
    {
        return $this->getCard() ? $this->getCard()->getValidParticipations() : [];
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
        $guest = new self();
        $guest->setCard($this->card)
            ->setName($this->name)
            ->setExternalLink($this->externalLink)
            ->setVignette($this->vignette)
            ->setAltVignette($this->altVignette)
            ->setCoverPhoto($this->coverPhoto)
            ->setAltCoverPhoto($this->altCoverPhoto)
            ->setBiography($this->biography)
            ->setGuestOfHonor($this->guestOfHonor)
            ->setThisFriday($this->thisFriday)
            ->setThisSaturday($this->thisSaturday)
            ->setThisSunday($this->thisSunday)
            ->setUnivers($this->univers)
            ->setEdition($this->edition)
            ;

        return $guest;
    }

    public function getSupportedCardClass()
    {
        return CardGuest::class;
    }

    public function activeView($option = [])
    {
    }
}
