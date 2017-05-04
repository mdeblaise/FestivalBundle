<?php

namespace MMC\FestivalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

class PlayType extends AbstractType
{
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'form_firstname'])
            ->add('lastname', TextType::class, ['label' => 'form_lastname'])
            ->add('email', EmailType::class, ['label' => 'form_email'])
            ->add('phone', TextType::class, ['label' => 'form_phone', 'attr' => ['placeholder' => 'ex: 0123456789']])
            ->add('departmentNumber', TextType::class, ['label' => 'form_departmentNumber', 'attr' => ['placeholder' => 'ex: 37']])
            ->add('receiveInformation', CheckboxType::class, ['label' => 'form_receiveInformation', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('translation_domain', 'play');
    }
}
