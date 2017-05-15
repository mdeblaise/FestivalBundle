<?php

namespace MMC\FestivalBundle\Entity\Behavior;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields=["globalCode", "edition"], message="Cette version est déjà utilisée.")
 */
trait RelatedEditionTrait
{
    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(type="uuid")
     */
    protected $globalCode;

    /**
     * @ORM\ManyToOne(targetEntity="MMC\FestivalBundle\Entity\Edition")
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    protected $edition;

    public function getGlobalCode()
    {
        return $this->globalCode;
    }

    /**
     * @param type $globalCode
     */
    public function setGlobalCode($globalCode)
    {
        $this->globalCode = $globalCode;

        return $this;
    }

    /**
     * @return MMC\FestivalBundle\Entity\Edition
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param MMC\FestivalBundle\Entity\Edition $edition
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }
}
