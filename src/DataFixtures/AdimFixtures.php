<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Administrateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdimFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {  
        $administrateur = new Administrateur();
        $administrateur->setEmail('admin@gmail.com');
        $administrateur->setPassword($this->passwordEncoder->encodePassword($administrateur,'admin'));
        $administrateur->setRoles(['ROLE_ADMIN']);
        $manager->persist($administrateur);
        $manager->flush();
    }
}