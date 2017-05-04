<?php

namespace MMC\FestivalBundle\Services\Carousel;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class DoctrineCarousel extends AbstractCarousel
{
    protected $repository;
    protected $view;

    public function __construct($name, EntityRepository $repository)
    {
        parent::__construct($name);

        $this->repository = $repository;
    }

    protected function addItem(CarouselImageViewInterface $item)
    {
        $image = new CarouselImageView();
        $image->setTitle($item->getTitle())
            ->setLink($item->getLink())
            ->setSrc($item->getSrc())
            ->setAlt($item->getAlt())
            ;

        $this->view->addImage($image);
    }

    protected function _getView()
    {
        if (!$this->view) {
            $this->view = new CarouselView($this->name);

            $queryBuilder = $this->repository->createQueryBuilder('x');

            foreach ($this->createQueryBuilder()->getQuery()->getResult() as $item) {
                $carouselView = $this->addItem($item);
            }
        }

        return $this->view;
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('x');
    }
}
