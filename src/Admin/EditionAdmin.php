<?php

namespace MMC\FestivalBundle\Admin;

use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class EditionAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_edition';
    protected $baseRoutePattern = 'edition';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('currentEdition', $this->getRouterIdParameter().'/currentEdition');
    }

    public function getBatchActions()
    {
        return [];
    }

    public function configure()
    {
        parent:: configure();

        $this->setTemplate('validate', 'MMCFestivalBundle:Admin:validate_current_edition.html.twig');
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
            ->add('name', null, [
                'sortable' => true,
            ])
            ->add('referenceDate', 'date', [
                'sortable' => true,
                'format' => 'd-m-Y',
                'timezone' => 'Europe/Paris',
            ])
            ->add('festivalLength', 'text', [
                'sortable' => true,
            ])
            ->add('preparationLength', 'text', [
                'sortable' => true,
            ])
            ->add('current', 'boolean', [
                'sortable' => true,
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'currentEdition' => [
                        'template' => 'MMCFestivalBundle:Admin:current_edition.html.twig',
                        'catalogue' => 'EditionManagement',
                    ],
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
                ->add('name')
                ->add('referenceDate', 'date', [
                    'format' => 'd-m-Y',
                    'timezone' => 'Europe/Paris',
                ])
                ->add('festivalLength')
                ->add('preparationLength')
                ->add('current', 'boolean')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Detail')
                ->add('name')
                ->add('referenceDate', 'date')
                ->add('festivalLength')
                ->add('preparationLength')
                ->add('current')
            ->end()
        ;
    }

    public function getExportFields()
    {
    }
}
