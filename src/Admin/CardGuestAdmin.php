<?php

namespace MMC\FestivalBundle\Admin;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\CardBundle\Admin\DTOCardAdmin;
use MMC\CardBundle\Form\Type\StatusValidationType;
use MMC\FestivalBundle\Services\EnumUniversProviderAwareTrait;
use MMC\SonataAdminBundle\Datagrid\DTOFieldDescription;
use MMC\SonataAdminBundle\Form\Type\ImagePreviewType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class CardGuestAdmin extends DTOCardAdmin
{
    use EnumUniversProviderAwareTrait;

    protected $baseRouteName = 'mmc_admin_card_guest';
    protected $baseRoutePattern = 'invites';

    protected $uploadableManager;

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'name',
    ];

    public function setUploadableManager(UploadableManager $uploadableManager)
    {
        $this->uploadableManager = $uploadableManager;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, [
                'sortable' => true,
                'sort_field_mapping' => 'iv.name',
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
            ['name' => 'name'],
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'catalogue' => 'univers',
                'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
            ]],
            ['name' => 'external_link'],
            ['name' => 'vignette', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'altVignette', 'type' => 'text'],
            ['name' => 'cover_photo', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'altCoverPhoto', 'type' => 'text'],
            ['name' => 'biography', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_raw.html.twig',
            ]],
            ['name' => 'guest_of_honor', 'type' => 'boolean'],
            ['name' => 'this_friday', 'type' => 'boolean'],
            ['name' => 'this_saturday', 'type' => 'boolean'],
            ['name' => 'this_sunday', 'type' => 'boolean'],
            ['name' => 'edition', 'type' => 'string'],
        ];
    }

    public function getItemFormFields($draft = false)
    {
        return [

            ['name' => 'status', 'type' => StatusValidationType::class, 'options' => ['card' => $this->getSubject()]],
            ['name' => 'name', 'type' => 'text', 'options' => [
                'attr' => ['data-limits' => '20|30'],
                'help' => 'name.limits',
            ]],
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_domain' => 'univers',
            ]],
            ['name' => 'external_link', 'type' => 'text', 'options' => ['required' => false]],
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
            ['name' => 'cover_photo', 'type' => ImagePreviewType::class],
            ['name' => 'altCoverPhoto', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'biography', 'type' => 'textarea', 'options' => ['required' => false]],
            ['name' => 'guest_of_honor', 'type' => 'checkbox', 'options' => ['required' => false]],
            ['name' => 'this_friday', 'type' => 'checkbox',  'options' => ['required' => false]],
            ['name' => 'this_saturday', 'type' => 'checkbox',  'options' => ['required' => false]],
            ['name' => 'this_sunday', 'type' => 'checkbox',  'options' => ['required' => false]],
        ];
    }

    public function configureItemFormFields($alias, FormMapper $formMapper)
    {
        $formMapper
            ->add($alias.'.name', 'text', ['label' => 'name'])
            ;
    }

    public function getExtraQueryFields()
    {
        return [
            'iv.name',
            'iv.externalLink',
            'iv.univers',
            'iv.guestOfHonor',
            'iv.thisFriday',
            'iv.thisSaturday',
            'iv.thisSunday',
            'iv.vignette',
            'iv.altVignette',
            'iv.coverPhoto',
            'iv.altCoverPhoto',
            'iv.edition',
        ];
    }

    public function getExportFields()
    {
        return [
            'name' => new DTOFieldDescription('name'),
            'external_link' => new DTOFieldDescription('external_link'),
            'altVignette' => new DTOFieldDescription('altVignette'),
            'altCoverPhoto' => new DTOFieldDescription('altCoverPhoto'),
            'univers' => new DTOFieldDescription('univers', 'enum', [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_pattern' => '%s',
                'translation_domain' => 'Univers',
            ]),
            'guestOfHonor' => new DTOFieldDescription('guestOfHonor', 'boolean', [
                'translation_pattern' => '%s',
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
        return DTO\CardGuest::class;
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
