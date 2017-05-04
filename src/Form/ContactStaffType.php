<?php

namespace MMC\FestivalBundle\Form;

use Greg0ire\Enum\Bridge\Symfony\Form\Type\EnumType;
use MMC\FestivalBundle\Services\EnumUniversProviderInterface;
use MMC\FestivalBundle\Services\Schedule\ScheduleProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactStaffType extends AbstractType
{
    protected $universProvider;

    protected $scheduleProvider;

    public function __construct(
        EnumUniversProviderInterface $universProvider,
        ScheduleProvider $scheduleProvider
    ) {
        $this->universProvider = $universProvider;
        $this->scheduleProvider = $scheduleProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'form_firstname'])
            ->add('lastname', TextType::class, ['label' => 'form_lastname'])
            ->add('email', EmailType::class, ['label' => 'form_email'])
            ->add('phone', TextType::class, ['label' => 'form_phone'])
            ->add('birthday', BirthdayType::class, ['label' => 'form_birthday', 'format' => 'ddMMyyyy', 'years' => range(2000, 1900)])
            ->add('univers', EnumType::class, [
                'class' => $this->universProvider->getClassname(),
                'expanded' => true,
                'multiple' => true,
                'label' => 'form_univers',
                'label_attr' => ['class' => 'checkbox-inline'],
                'choice_translation_domain' => 'univers',
            ])
            ->add('whyWishYouJoin', TextType::class, ['label' => 'form_why_wish_you_join'])
            ->add('whatDoYouLikeToDo', TextType::class, ['label' => 'form_what_do_you_like_to_do'])
            ->add('availabilities', ChoiceType::class, [
                'choices' => $this->scheduleProvider->getStaffTimeSlots(),
                'expanded' => true,
                'multiple' => true,
                'label' => 'form_availabilities',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('translation_domain', 'staff');
    }
}
