<?php

namespace MMC\FestivalBundle\Services\Carousel;

use Symfony\Component\Finder\Finder;

class FileFinderCarousel extends AbstractCarousel
{
    protected $path;

    protected $rootPath = __DIR__.'/../../Resources/web/src/images/';

    protected $webPath = '/dist/FrontBundle/images/';

    public function __construct($name, $path)
    {
        parent::__construct($name);
        $this->name = $name;
        $this->path = $path;
    }

    protected function _getView()
    {
        $finder = new Finder();
        $finder->files()->in($this->getRootPath().$this->getPath());
        $finder->sortByName();

        $view = new CarouselView($this->name);

        foreach ($finder as $file) {
            $image = new CarouselImageView();
            $image->setSrc($this->getWebPath().$this->getPath().'/'.$file->getFilename());

            $view->addImage($image);
        }

        return $view;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return stinrg
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param stinrg $rootPath
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebPath()
    {
        return $this->webPath;
    }

    /**
     * @param string $webPath
     */
    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;

        return $this;
    }
}
