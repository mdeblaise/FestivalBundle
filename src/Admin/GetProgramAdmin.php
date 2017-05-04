<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\FestivalBundle\Model\Civility;
use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class GetProgramAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_get_program';
    protected $baseRoutePattern = 'getProgram';

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
                ->add('civility', EnumType::class, [
                    'class' => Civility::class,
                    'catalogue' => 'Civility',
                    'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
                ])
                ->add('lastname')
                ->add('firstname')
                ->add('email')
                ->add('phone')
                ->add('address')
                ->add('postalCode')
                ->add('city')
                ->add('receiveInformation')
                ->add('notTransmitData')
            ->end()
        ;
    }

    public function getExportFields()
    {
        return [
            'CreatedAt' => new DTOFieldDescription('createdAt', 'datetime'),
            'Civility' => new DTOFieldDescription('civility', 'enum', [
                'class' => Civility::class,
                'translation_pattern' => '%s',
                'translation_domain' => 'Civility',
            ]),
            'Firstname' => new DTOFieldDescription('firstname'),
            'Lastname' => new DTOFieldDescription('lastname'),
            'Email' => new DTOFieldDescription('email'),
            'Phone' => new DTOFieldDescription('phone'),
            'Adress' => new DTOFieldDescription('adress'),
            'PostalCode' => new DTOFieldDescription('postalCode'),
            'City' => new DTOFieldDescription('city'),
            'ReceiveInformation' => new DTOFieldDescription('receiveInformation', 'boolean', [
                'translation_pattern' => '%s',
                'translation_domain' => 'GetProgram',
            ]),
            'NotTransmitData' => new DTOFieldDescription('notTransmitData', 'boolean', [
                'translation_pattern' => '%s',
                'translation_domain' => 'GetProgram',
            ]),
        ];
    }
}
