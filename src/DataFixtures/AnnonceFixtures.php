<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Migrations\Version\Factory;

class AnnonceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        for ($i=1;$i<=1000;$i++)
        {
            $annonce = new Annonce();
            $annonce->setTitre($faker->words(10, true));
            $annonce->setContenu($faker->realText($maxNbChars = 200, $indexSize = 2));
            $annonce->setDateAjout($faker->dateTime);

            $manager->persist($annonce);
        }
          

          $manager->flush();
    }
}
