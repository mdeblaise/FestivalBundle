<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\CardBundle\Admin\DTOCardAdmin;
use MMC\CardBundle\Form\Type\StatusValidationType;
use MMC\FestivalBundle\Model\LinkTarget;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use MMC\SonataAdminBundle\Form\Type\ImagePreviewType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class CardActualityAdmin extends DTOCardAdmin
{
    protected $baseRouteName = 'mmc_admin_card_actuality';
    protected $baseRoutePattern = 'actualites';

    protected $uploadableManager;

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'publishedAt',
    ];

    public function setUploadableManager(UploadableManager $uploadableManager)
    {
        $this->uploadableManager = $uploadableManager;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, [
                'sortable' => true,
                'sort_field_mapping' => 'iv.title',
                'route' => [
                    'name' => 'show', ],
            ])
            ->add('publishedAt', 'datetime', [
                'sortable' => true,
                'sort_field_mapping' => 'iv.publishedAt',
            ])
            ->add('illustration', null, [
                'template' => 'MMCSonataAdminBundle:CRUD:list_image_preview.html.twig',
            ])
            ->add('valid', 'boolean')
            ->add('draft', 'boolean', [
                'template' => 'MMCCardBundle:Card:list_draft.html.twig',
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                ],
            ])
            ;
    }

    protected function getItemShowFields($draft = false)
    {
        return [
            ['name' => 'status', 'options' => [
                'template' => 'MMCCardBundle:CRUD:show_validation.html.twig',
            ]],
            ['name' => 'title'],
            ['name' => 'publishedAt', 'type' => 'datetime', 'options' => ['widget' => 'single_text']],
            ['name' => 'contents'],
            ['name' => 'illustration', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'alt', 'type' => 'text'],
            ['name' => 'link', 'type' => 'text'],
            ['name' => 'target', 'type' => EnumType::class, 'options' => [
                'class' => LinkTarget::class,
                'catalogue' => 'LinkTarget',
                'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
            ]],

        ];
    }

    public function getItemFormFields($draft = false)
    {
        return [
            ['name' => 'status', 'type' => StatusValidationType::class, 'options' => ['card' => $this->getSubject()]],
            ['name' => 'title', 'type' => 'text', 'options' => [
                'attr' => ['data-limits' => '20|26'],
                'help' => 'title.limits',
            ]],
            ['name' => 'publishedAt', 'type' => 'sonata_type_datetime_picker', 'options' => [
                'dp_side_by_side' => true,
                'required' => false,
                'format' => 'yyyy/MM/dd HH:mm',
            ]],
            ['name' => 'contents', 'type' => 'text', 'options' => [
                'required' => false,
                'attr' => ['data-limits' => '50|65'],
                'help' => 'contents.limits',
            ]],
            ['name' => 'file', 'type' => 'file', 'options' => [
                'required' => false,
                'mapped' => true,
                'help' => 'image.help',
            ]],
            ['name' => 'illustration', 'type' => ImagePreviewType::class],
            ['name' => 'alt', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'link', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'target', 'type' => EnumType::class, 'options' => [
                'class' => LinkTarget::class,
                'choice_translation_domain' => 'LinkTarget',
            ]],
        ];
    }

    public function getExtraQueryFields()
    {
        return [
            'iv.title',
            'iv.publishedAt',
            'iv.illustration',
            'iv.contents',
            'iv.alt',
            'iv.link',
        ];
    }

    public function getExportFields()
    {
        return [
            'title' => new DTOFieldDescription('title'),
            'publishedAt' => new DTOFieldDescription('publishedAt', 'datetime'),
            'contents' => new DTOFieldDescription('contents'),
            'alt' => new DTOFieldDescription('alt'),
            'link' => new DTOFieldDescription('link'),
            'isValid' => new DTOFieldDescription('valid', 'boolean', [
                'translation_pattern' => 'is_valid.%s',
            ]),
            'isDraft' => new DTOFieldDescription('draft', 'boolean', [
                'translation_pattern' => 'is_draft.%s',
            ]),
        ];
    }

    public function getDTOClassName()
    {
        return DTO\CardActuality::class;
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
        $draftItem = $object->getDraft();
        if ($draftItem->getFile()) {
            $this->uploadableManager->markEntityToUpload($draftItem, $draftItem->getFile());
        }
    }
}
