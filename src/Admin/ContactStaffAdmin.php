<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactStaffAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_contact_staff';
    protected $baseRoutePattern = 'staff';
    protected $universClass;

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['export', 'list', 'show']);
    }

    public function getBatchActions()
    {
        return [];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('createdAt', 'doctrine_orm_date_range', ['field_type' => 'sonata_type_date_range_picker'])
            ->add('univers', 'doctrine_orm_choice', [
                'field_options' => [
                    'choices' => $this->universClass::getConstants('strtolower'),
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'choice_translation_domain' => 'univers',
                ],
                'field_type' => 'choice',
            ])
            ->add('availabilities', 'doctrine_orm_choice', [
                'field_options' => [
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                ],
                'field_type' => 'choice',
            ])
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
            ->add('lastname', null, [
                'sortable' => true,
            ])
            ->add('firstname', null, [
                'sortable' => true,
            ])
            ->add('email', 'email', [
                'sortable' => false,
            ])
            ->add('phone', null, [
                'sortable' => false,
            ])
            ->add('birthday', 'date', [
                'sortable' => false,
                'format' => 'd/m/Y',
            ])
            ->add('univers', null, [
                'class' => $this->universClass,
                'catalogue' => 'univers',
                'template' => 'MMCFestivalBundle:Univers:list_univers.html.twig',
                'sortable' => false,
            ])
            ->add('availabilities', null, [
                    'template' => 'MMCFestivalBundle:Schedule:list_schedule.html.twig',
                    'sortable' => false,
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
                ->add('lastname')
                ->add('firstname')
                ->add('email')
                ->add('phone')
                ->add('birthday', 'date', [
                    'format' => 'd/m/Y',
                ])
                ->add('univers', null, [
                    'class' => $this->universClass,
                    'catalogue' => 'univers',
                    'template' => 'MMCFestivalBundle:Univers:show_univers.html.twig',
                    'sortable' => true,
                ])
                ->add('whyWishYouJoin')
                ->add('whatDoYouLikeToDo')
                ->add('availabilities', null, [
                    'template' => 'MMCFestivalBundle:Schedule:show_schedule.html.twig',
                ])
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

    public function setUniversClass($universClass)
    {
        $this->universClass = $universClass;

        return $this;
    }
}
