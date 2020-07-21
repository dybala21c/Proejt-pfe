<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Date')
            ->add('Lieu')
            ->add('HeureDebut')
            ->add('HeureFin')
            ->add('Photo', FileType::class,[
                'label'=> 'Photo ( Image png ou jpg )',
                'mapped'=> false,
                'required'=>false,
                'constraints'=>[
                    new File([
                        'maxSize'=> '1024k',
                        'mimeTypes' =>[
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir une image jpg ou png ',
                    ])
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
