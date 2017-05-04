<?php

namespace MMC\FestivalBundle\Admin;

use MMC\SonataAdminBundle\Admin\AbstractAdmin;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use MMC\SonataAdminBundle\Form\Type\ImagePreviewType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class PartnerAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'mmc_admin_manage_partners';
    protected $baseRoutePattern = 'managePartners';
    protected $uploadableManager;

    public function setUploadableManager(UploadableManager $uploadableManager)
    {
        $this->uploadableManager = $uploadableManager;
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

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, [
                'sortable' => true,
                'route' => [
                    'name' => 'show', ],
            ])
            ->add('logo', 'options', [
                'template' => 'MMCSonataAdminBundle:CRUD:list_image_preview.html.twig',
                'sortable' => false,
            ])
            ->add('createdAt', 'datetime', [
                'sortable' => true,
                'format' => 'Y-m-d H:i',
                'timezone' => 'Europe/Paris',
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Partners')
                ->add('name')
                ->add('link')
            ;
        if ($this->id($this->getSubject())) {
            $formMapper
                    ->add('file', 'file', [
                        'label' => 'Logo',
                        'mapped' => true,
                        'required' => true,
                    ])
                    ->add('logo', ImagePreviewType::class, [
                        'label' => 'Preview',
                    ])
                ;
        } else {
            $formMapper
                    ->add('file', 'file', [
                        'label' => 'Logo',
                        'mapped' => true,
                        'required' => true,
                    ])
                ;
        }

        $formMapper
                ->add('alt')
            ->end()
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Partners')
                ->add('name')
                ->add('link')
                ->add('logo', 'options', [
                    'template' => 'MMCSonataAdminBundle:CRUD:list_image_preview.html.twig',
                    'sortable' => false,
                ])
                ->add('alt')
                ->add('createdAt', 'datetime', [
                    'sortable' => true,
                    'format' => 'Y-m-d H:i',
                    'timezone' => 'Europe/Paris',
                ])
            ->end()
        ;
    }

    public function getExportFields()
    {
        return [
            'Name' => new DTOFieldDescription('name'),
            'CreatedAt' => new DTOFieldDescription('createdAt', 'datetime'),
            'Link' => new DTOFieldDescription('link'),
        ];
    }

    public function prePersist($object)
    {
        $this->uploadFiles($object);
    }
    public function preUpdate($object)
    {
        $this->uploadFiles($object);
    }
    protected function uploadFiles($object)
    {
        if ($object->getFile()) {
            $this->uploadableManager->markEntityToUpload($object, $object->getFile());
        }
    }
}
