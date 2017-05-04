<?php

namespace MMC\FestivalBundle\Admin\DTO;

use MMC\CardBundle\Admin\DTO\Card;

class CardActuality extends Card
{
    protected $title;

    protected $publishedAt;

    protected $illustration;

    public function __construct(
        $id,
        $uuid,
        $status,
        $isDraft,
        $title,
        $publishedAt,
        $illustration,
        $contents,
        $alt,
        $link
    ) {
        parent::__construct($id, $uuid, $status, $isDraft);

        $this->title = $title;
        $this->publishedAt = $publishedAt;
        $this->illustration = $illustration;
        $this->contents = $contents;
        $this->alt = $alt;
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return datetime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return string
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
