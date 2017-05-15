<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactExponentAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_contact_exponent';
    protected $baseRoutePattern = 'contactExponent';

    public function configure()
    {
        parent:: configure();

        $this->setTemplate('show', 'MMCFestivalBundle:Admin:show.html.twig');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('add_exponent', $this->getRouterIdParameter().'/addExponent');
        $collection->clearExcept(['export', 'list', 'show', 'add_exponent']);
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
            ->addIdentifier('socialReason', null, [
                'sortable' => true,
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
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
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
                ->add('socialReason')
                ->add('lastname')
                ->add('firstname')
                ->add('email')
                ->add('phone')
                ->add('typeProducts')
                ->add('message')
            ->end()
        ;
    }

    public function getExportFields()
    {
        return [
            'CreatedAt' => new DTOFieldDescription('createdAt', 'datetime'),
            'SocialReason' => new DTOFieldDescription('socialReason'),
            'Lastname' => new DTOFieldDescription('lastname'),
            'Firstname' => new DTOFieldDescription('firstname'),
            'Email' => new DTOFieldDescription('email'),
            'Phone' => new DTOFieldDescription('phone'),
            'TypeProducts' => new DTOFieldDescription('typeProducts'),
            'Message' => new DTOFieldDescription('message'),
        ];
    }
}
