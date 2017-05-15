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

class CardExponentAdmin extends DTOCardAdmin
{
    use EnumUniversProviderAwareTrait;

    protected $baseRouteName = 'mmc_admin_card_exponent';
    protected $baseRoutePattern = 'exposants';

    protected $uploadableManager;

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'name',
    ];

    public function configure()
    {
        parent:: configure();

        $this->setTemplate('show', 'MMCFestivalBundle:Admin:exponent_show.html.twig');
    }

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
            ->add('email', 'email')
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
            ['name' => 'name', 'type' => 'text'],
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'catalogue' => 'univers',
                'template' => 'MMCSonataAdminBundle:Enum:show_enum.html.twig',
            ]],
            ['name' => 'vignette', 'options' => [
                'template' => 'MMCSonataAdminBundle:CRUD:show_image_preview.html.twig',
            ]],
            ['name' => 'alt', 'type' => 'text'],
            ['name' => 'email', 'type' => 'text'],
            ['name' => 'website', 'type' => 'text'],
            ['name' => 'descriptif', 'type' => 'text'],
            ['name' => 'stand', 'type' => 'text'],
            ['name' => 'level', 'type' => 'text'],
            ['name' => 'edition', 'type' => 'string'],
        ];
    }

    public function getItemFormFields($draft = false)
    {
        return [
            ['name' => 'status', 'type' => StatusValidationType::class, 'options' => ['card' => $this->getSubject()]],
            ['name' => 'name', 'type' => 'text', 'options' => [
                'attr' => ['data-limits' => '30|40'],
                'help' => 'name.limits',
            ]],
            ['name' => 'univers', 'type' => EnumType::class, 'options' => [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_domain' => 'univers',
            ]],
            ['name' => 'file', 'type' => 'file', 'options' => [
                'required' => false,
                'mapped' => true,
                'help' => 'image.help',
            ]],
            ['name' => 'removeFile', 'type' => 'checkbox', 'options' => [
                'required' => false,
            ]],
            ['name' => 'vignette', 'type' => ImagePreviewType::class],
            ['name' => 'alt', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'email', 'type' => 'email', 'options' => ['required' => false]],
            ['name' => 'website', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'descriptif', 'type' => 'text', 'options' => [
                'required' => false,
                'attr' => ['data-limits' => '105|135'],
                'help' => 'descriptif.limits',
            ]],
            ['name' => 'stand', 'type' => 'text', 'options' => ['required' => false]],
            ['name' => 'level', 'type' => 'text', 'options' => ['required' => false]],
        ];
    }

    public function getExtraQueryFields()
    {
        return [
            'iv.name',
            'iv.descriptif',
            'iv.website',
            'iv.email',
            'iv.stand',
            'iv.level',
            'iv.univers',
            'iv.vignette',
            'iv.alt',
            'iv.edition',
        ];
    }

    public function getExportFields()
    {
        return [
            'name' => new DTOFieldDescription('name'),
            'univers' => new DTOFieldDescription('univers', 'enum', [
                'class' => $this->getEnumUniversProvider()->getClassname(),
                'translation_pattern' => '%s',
                'translation_domain' => 'Univers',
            ]),
            'descriptif' => new DTOFieldDescription('descriptif'),
            'alt' => new DTOFieldDescription('alt'),
            'website' => new DTOFieldDescription('website'),
            'email' => new DTOFieldDescription('email'),
            'stand' => new DTOFieldDescription('stand'),
            'level' => new DTOFieldDescription('level'),
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
        return DTO\CardExponent::class;
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

        if ($draftItem->getRemoveFile()) {
            $draftItem->setVignette(null);
        }

        if ($draftItem->getFile()) {
            $this->uploadableManager->markEntityToUpload($draftItem, $draftItem->getFile());
        }
    }
}
