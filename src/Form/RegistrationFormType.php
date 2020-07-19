<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Categorie;
use App\Entity\Grade1;
use App\Entity\Personnel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Cin',IntegerType::class)
            ->add('Nom',TextType::class)
            ->add('Prenom',TextType::class)
            ->add('username')
            ->add('Adresse',TextType::class)
            ->add('Telephone',IntegerType::class)
            ->add('DateNaissance',DateType::class)
            ->add('Bureau',EntityType::class,[
                'class'=>Bureau::class,
                'choice_label'=>'Numero'
            ])
            ->add('Categorie',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'Libelle'
            ])
            ->add('Grade',EntityType::class,[
                'class'=>Grade1::class,
                'choice_label'=>'Libelle'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
