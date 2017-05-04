<?php

namespace MMC\FestivalBundle\Services\Actuality;

use MMC\FestivalBundle\Model\Status;
use MMC\FestivalBundle\Services\DateReference;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestFactory
{
    protected $dateReference;
    protected $maxPerPage;

    public function __construct(DateReference $dateReference, $maxPerPage)
    {
        $this->dateReference = $dateReference;
        $this->maxPerPage = $maxPerPage;
    }

    public function create($options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'admin' => false,
            'page' => 1,
        ]);

        $resolver->setAllowedTypes('admin', 'boolean');
        $resolver->setAllowedTypes('page', ['string', 'integer']);

        $options = $resolver->resolve($options);

        $request = new Request();

        $request->setDateReference($this->dateReference->getDate());
        $request->setMaxPerPage($this->maxPerPage);
        $request->setStatus($options['admin'] ? [Status::VALID, Status::DRAFT, Status::CREATING] : [Status::VALID]);
        $request->setCurrentPage($options['page']);

        return $request;
    }
}
