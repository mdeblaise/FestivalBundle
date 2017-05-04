<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\FestivalBundle\Model\Civility;
use MMC\FestivalBundle\Model\Media;
use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactPressAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_contact_press';
    protected $baseRoutePattern = 'presse';

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
            ->add('media', 'doctrine_orm_choice', [
                'field_options' => [
                    'choices' => Media::getConstants('strtolower'),
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'choice_translation_domain' => 'Media',
                ],
                'field_type' => 'choice',
            ])
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
            ->add('media', null, [
                'class' => Media::class,
                'catalogue' => 'Media',
                'template' => 'MMCSonataAdminBundle:Enum:list_enum.html.twig',
                'sortable' => true,
            ])
            ->add('email', 'email', [
                'sortable' => false,
            ])
            ->add('phone', null, [
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
                ->add('media', EnumType::class, [
                    'class' => Media::class,
                    'catalogue' => 'Media',
                    'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
                ])
                ->add('email')
                ->add('phone')
                ->add('address')
                ->add('postalCode')
                ->add('city')
                ->add('message')
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
            'Media' => new DTOFieldDescription('media', 'enum', [
                'class' => Media::class,
                'translation_pattern' => '%s',
                'translation_domain' => 'Media',
            ]),
            'Email' => new DTOFieldDescription('email'),
            'Phone' => new DTOFieldDescription('phone'),
            'Adress' => new DTOFieldDescription('adress'),
            'PostalCode' => new DTOFieldDescription('postalCode'),
            'City' => new DTOFieldDescription('city'),
            'Message' => new DTOFieldDescription('message'),
        ];
    }
}
