<?php

namespace MMC\FestivalBundle\Form;

use MMC\FestivalBundle\Model\Civility;
use MMC\FestivalBundle\Model\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

class ContactPressType extends AbstractType
{
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'choices' => Civility::getConstants('strtolower'),
                'choice_translation_domain' => 'civility',
                'label' => 'form_civility',
            ])
            ->add('firstname', TextType::class, ['label' => 'form_firstname'])
            ->add('lastname', TextType::class, ['label' => 'form_lastname'])
            ->add('media', ChoiceType::class, [
                'choices' => Media::getConstants('strtolower'),
                'choice_translation_domain' => 'media',
                'label' => 'form_media',
            ])
            ->add('email', EmailType::class, ['label' => 'form_email'])
            ->add('phone', TextType::class, ['label' => 'form_phone'])
            ->add('address', TextType::class, ['label' => 'form_address'])
            ->add('postalCode', TextType::class, ['label' => 'form_postalCode'])
            ->add('city', TextType::class, ['label' => 'form_city'])
            ->add('message', TextareaType::class, ['label' => 'form_message'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('translation_domain', 'press');
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // Order translated races
        $collator = new \Collator($this->translator->getLocale());
        usort(
            $view->children['media']->vars['choices'],
            function ($a, $b) use ($collator) {
                return $collator->compare(
                    $this->translator->trans($a->label, [], 'media'),
                    $this->translator->trans($b->label, [], 'media')
                );
            }
        );
        usort(
            $view->children['civility']->vars['choices'],
            function ($a, $b) use ($collator) {
                return $collator->compare(
                    $this->translator->trans($a->label, [], 'civility'),
                    $this->translator->trans($b->label, [], 'civility')
                );
            }
        );
    }
}
