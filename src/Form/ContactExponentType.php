<?php

namespace MMC\FestivalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactExponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'form_firstname'])
            ->add('lastname', TextType::class, ['label' => 'form_lastname'])
            ->add('email', EmailType::class, ['label' => 'form_email'])
            ->add('phone', TextType::class, ['label' => 'form_phone', 'required' => false])
            ->add('socialReason', TextType::class, ['label' => 'form_social_reason', 'required' => false])
            ->add('typeProducts', TextareaType::class, ['label' => 'form_type_products', 'required' => false])
            ->add('message', TextareaType::class, ['label' => 'form_message', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('translation_domain', 'exponent');
    }
}
