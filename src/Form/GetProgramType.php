<?php

namespace MMC\FestivalBundle\Form;

use MMC\FestivalBundle\Model\Civility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

class GetProgramType extends AbstractType
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
            ->add('phone', TextType::class, ['label' => 'form_phone'])
            ->add('email', EmailType::class, ['label' => 'form_email'])
            ->add('address', TextType::class, ['label' => 'form_address'])
            ->add('postalCode', TextType::class, ['label' => 'form_postalCode'])
            ->add('city', TextType::class, ['label' => 'form_city'])
            ->add('receiveInformation', CheckboxType::class, ['label' => 'form_receiveInformation', 'required' => false])
            ->add('notTransmitData', CheckboxType::class, ['label' => 'form_notTransmitData', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('translation_domain', 'getProgram');
    }
}
