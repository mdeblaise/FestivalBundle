<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class EditionAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_edition';
    protected $baseRoutePattern = 'edition';
    protected $universClass;


    public function getBatchActions()
    {
        return [];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('createdAt', 'doctrine_orm_date_range', ['field_type' => 'sonata_type_date_range_picker'])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('createdAt', 'datetime', [
                'sortable' => true,
                'format' => 'Y-m-d H:i',
                'timezone' => 'Europe/Paris',
            ])
            ->add('year', null, [
                'sortable' => true,
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Detail')
                ->add('year')
            ->end()
        ;
    }

    public function getExportFields()
    {
        return [
            'CreatedAt' => new DTOFieldDescription('createdAt', 'datetime'),
            'Lastname' => new DTOFieldDescription('lastname'),
            'Firstname' => new DTOFieldDescription('firstname'),
            'Email' => new DTOFieldDescription('email'),
            'Phone' => new DTOFieldDescription('phone'),
            'Birthday' => new DTOFieldDescription('birthday', 'date'),
            'Univers' => new DTOFieldDescription('univers', 'enum', [
                'class' => $this->universClass,
                'translation_pattern' => '%s',
                'translation_domain' => 'univers',
            ]),
            'WhyWishYouJoin' => new DTOFieldDescription('whyWishYouJoin'),
            'WhatDoYouLikeToDo' => new DTOFieldDescription('whatDoYouLikeToDo'),
        ];
    }
}
