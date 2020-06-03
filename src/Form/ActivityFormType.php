<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ActivityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keyword')
            ->add('description')
            ->add('image', FileType::class,[
                'mapped'=>false,
                'required'=>false,
                'constraints'=> [

                    new File([

                        'maxSize'=>'2048k',
                        'mimeTypes'=>[
                            'image/*',
                        ],
                        'mimeTypesMessage'=>'Please enter a valid image file.',
                    ])

                ],

            ])
            ->add('adrenalineFactor')
            ->add('address')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('city')
            ->add('status')
            ->add('category')
            //->add('userid')
            ->add('detail', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
            'csrf_protection'=> false,
        ]);
    }
}



/*, FileType::class,[
                'mapped'=>false,
                'required'=>false,
                'constraints'=> [

                    new File([

                        'maxSize'=>'2048k',
                        'mimeTypes'=>[
                            'image/*',
                        ],
                        'mimeTypesMessage'=>'Please enter a valid image file.',
                    ])

                ],

            ]
*/