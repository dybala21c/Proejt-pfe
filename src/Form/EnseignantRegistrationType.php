<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Categorie;
use App\Entity\Grade1;
use App\Entity\NiveauEtude;
use App\Entity\Specialite;
use App\Entity\Enseignant;
use App\Entity\Sceance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('password')
            ->add('Matricule')
            ->add('Name',TextType::class)
            ->add('Prenom',TextType::class)
            ->add('Date_Naissance', DateType::class, [ 
                'widget' => 'single_text',
            ])
            ->add('Adresse',TextType::class)
            ->add('Telephone',IntegerType::class)
            ->add('Nationalite', CountryType::class)
            ->add('Age',IntegerType::class)
            ->add('bureau',EntityType::class,[
                'class'=>Bureau::class,
                'choice_label'=>'Numero'
            ])
            ->add('Grade',EntityType::class,[
                'class'=>Grade1::class,
                'choice_label'=>'Libelle'
            ])    
            ->add('specialite',EntityType::class,[
                'class'=>Specialite::class,
                'choice_label'=>'Libelle'
            ])
            ->add('Niveau',EntityType::class,[
                'class'=>NiveauEtude::class,
                'choice_label'=>'Libelle'  
            ])  
            ->add('Sceance',EntityType::class,[
                'class'=>Sceance::class,
                'choice_label'=>'Libelle'  
            ])  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
