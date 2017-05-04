<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\CardBundle\Admin\DTOCardAdmin;
use MMC\CardBundle\Form\Type\StatusValidationType;
use MMC\FestivalBundle\Entity\CardGuest;
use MMC\FestivalBundle\Model\ActivityType;
use MMC\FestivalBundle\Services\EnumUniversProviderAwareTrait;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use MMC\SonataAdminBundle\Form\Type\ImagePreviewType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class CardActivityAdmin extends DTOCardAdmin
{
    use EnumUniversProviderAwareTrait;

    protected $baseRouteName = 'mmc_admin_card_activity';
    protected $baseRoutePattern = 'activites';

    protected $uploadableManager;

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'title',
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
            ->add('vignette', null, [
                'template' => 'MMCSonataAdminBundle:CRUD:list_image_preview.html.twig',
            ])
            ->add('univers', null, [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'catalogue' => 'univers',
                'template' => 'MMCSonataAdminBundle:Enum:list_enum.html.twig',
            ])
            ->add('type', null, [
                'class' => ActivityType::class,
                'catalogue' => 'CardActivity',
                'template' => 'MMCSonataAdminBundle:Enum:list_enum.html.twig',
            ])
            ->add('valid', 'boolean')
            ->add('draft', 'boolean', [
                'template' => 'MMCCardBundle:Card:list_draft.html.twig',
            ])
            ->add('edition', 'string')
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
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'catalogue' => 'univers',
                'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
            ]],
            ['name' => 'type', 'type' => EnumType::class, 'options' => [
                'class' => ActivityType::class,
                'catalogue' => 'CardActivity',
                'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',

            ]],
            ['name' => 'vignette', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'altVignette', 'type' => 'text'],
            ['name' => 'coverPhoto', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'altCoverPhoto', 'type' => 'text'],
            ['name' => 'descriptif', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_raw.html.twig',
            ]],
            ['name' => 'this_friday', 'type' => 'boolean'],
            ['name' => 'this_saturday', 'type' => 'boolean'],
            ['name' => 'this_sunday', 'type' => 'boolean'],
            ['name' => 'participations', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_collection.html.twig',
            ]],
            ['name' => 'edition', 'type' => 'string'],
        ];
    }

    public function getItemFormFields($draft = false)
    {
        return [
            ['name' => 'status', 'type' => StatusValidationType::class, 'options' => ['card' => $this->getSubject()]],
            ['name' => 'title', 'type' => 'text', 'options' => [
                'attr' => ['data-limits' => '32|50'],
                'help' => 'title.limits',
            ]],
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_domain' => 'univers',
            ]],
            ['name' => 'type', 'type' => EnumType::class, 'options' => [
                'class' => ActivityType::class,
                'translation_domain' => 'CardActivity',
            ]],
            ['name' => 'fileThumb', 'type' => 'file', 'options' => [
                'required' => false,
                'mapped' => true,
                'help' => 'image.help',
            ]],
            ['name' => 'vignette', 'type' => ImagePreviewType::class],
            ['name' => 'altVignette', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'fileCover', 'type' => 'file', 'options' => [
                'required' => false,
                'mapped' => true,
                'help' => 'image.help',
            ]],
            ['name' => 'coverPhoto', 'type' => ImagePreviewType::class],
            ['name' => 'altCoverPhoto', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'descriptif', 'type' => 'textarea', 'options' => ['required' => false]],
            ['name' => 'this_friday', 'type' => 'checkbox',  'options' => ['required' => false]],
            ['name' => 'this_saturday', 'type' => 'checkbox',  'options' => ['required' => false]],
            ['name' => 'this_sunday', 'type' => 'checkbox',  'options' => ['required' => false]],
            ['name' => 'participations', 'type' => 'entity', 'options' => [
                'multiple' => true,
                'class' => CardGuest::class,
            ]],
        ];
    }

    public function getExtraQueryFields()
    {
        return [
            'iv.title',
            'iv.type',
            'iv.univers',
            'iv.vignette',
            'iv.altVignette',
            'iv.coverPhoto',
            'iv.altCoverPhoto',
            'iv.thisFriday',
            'iv.thisSaturday',
            'iv.thisSunday',
            'iv.edition',
        ];
    }

    public function getExportFields()
    {
        return [
            'title' => new DTOFieldDescription('title'),
            'univers' => new DTOFieldDescription('univers', 'enum', [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_pattern' => '%s',
                'translation_domain' => 'Univers',
            ]),
            'altVignette' => new DTOFieldDescription('altVignette'),
            'altCoverPhoto' => new DTOFieldDescription('altCoverPhoto'),
            'type' => new DTOFieldDescription('type', 'enum', [
                'class' => ActivityType::class,
                'translation_pattern' => '%s',
                'translation_domain' => 'CardActivity',
            ]),
            'thisFriday' => new DTOFieldDescription('thisFriday', 'boolean', [
                'translation_pattern' => '%s',
            ]),
            'thisSaturday' => new DTOFieldDescription('thisSaturday', 'boolean', [
                'translation_pattern' => '%s',
            ]),
            'thisSunday' => new DTOFieldDescription('thisSunday', 'boolean', [
                'translation_pattern' => '%s',
            ]),
            'isValid' => new DTOFieldDescription('valid', 'boolean', [
                'translation_pattern' => 'is_valid.%s',
            ]),
            'isDraft' => new DTOFieldDescription('draft', 'boolean', [
                'translation_pattern' => 'is_draft.%s',
            ]),
            'edition' => new DTOFieldDescription('edition', 'string', [
                'translation_pattern' => '%s',
            ]),
        ];
    }

    public function getDTOClassName()
    {
        return DTO\CardActivity::class;
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
        if ($draftItem->getFileThumb()) {
            $this->uploadableManager->markEntityToUpload($draftItem, $draftItem->getFileThumb(), 'thumb');
        }
        if ($draftItem->getFileCover()) {
            $this->uploadableManager->markEntityToUpload($draftItem, $draftItem->getFileCover(), 'cover');
        }
    }
}
