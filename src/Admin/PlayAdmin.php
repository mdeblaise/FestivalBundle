<?php

namespace MMC\FestivalBundle\Admin;

use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PlayAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_play';
    protected $baseRoutePattern = 'play';

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
            ->add('departmentNumber', 'departmentNumber', [
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
                ->add('departmentNumber')
                ->add('receiveInformation')
            ->end()
        ;
    }

    public function getExportFields()
    {
        return [
            'CreatedAt' => new DTOFieldDescription('createdAt', 'datetime'),
            'Firstname' => new DTOFieldDescription('firstname'),
            'Lastname' => new DTOFieldDescription('lastname'),
            'Email' => new DTOFieldDescription('email'),
            'Phone' => new DTOFieldDescription('phone'),
            'DepartmentNumber' => new DTOFieldDescription('departmentNumber'),
            'ReceiveInformation' => new DTOFieldDescription('receiveInformation', 'boolean', [
                'translation_pattern' => '%s',
                'translation_domain' => 'Play',
            ]),
        ];
    }
}
