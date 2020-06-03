<?php

namespace App\Form;

use App\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('keyword')
            ->add('phone')
            ->add('mobile')
            ->add('fax')
            ->add('mail')
            ->add('address')
            ->add('google')
            ->add('recapctha')
            ->add('map')
            ->add('facebook')
            ->add('twitter')
            ->add('instagram')
            ->add('youtube')
            ->add('smtp_user')
            ->add('smtp_password')
            ->add('smtp_host')
            ->add('smtp_port')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
            'csrf_protection'=> false,
        ]);
    }
}
