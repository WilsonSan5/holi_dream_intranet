<?php

namespace App\DataFixtures;

use App\Repository\ProduitRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

use App\Entity\Produit;
use App\Entity\Planning;
use Faker\Provider\Lorem;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $product = new Produit();
            $product->setTitle($faker->sentence(3, true));
            $product->setIntroduction($faker->sentence(6, true));
            $product->setDescription($faker->sentence(100, true));
            $product->setNbrJour(mt_rand(10, 100));
            $product->setNbrNuit(mt_rand(10, 100));
            $product->setPrixDefaut(mt_rand(100, 5000));
            $product->setDescriptionProgramme($faker->sentence(5, true));

            for ($k = 1; $k < mt_rand(0, 6); $k++) {
                $planning = new Planning();
                $planning->setDateDepart($faker->dateTimeBetween('0 week', '+5 week'));
                $planning->setDateFin($faker->dateTimeBetween($planning->getDateDepart(), '+8 week'));
                $planning->setPrix(mt_rand(100, 5000));
                $planning->setProduit($product);
                
                $manager->persist($planning);
            }

            $manager->persist($product);
        }


        $manager->flush();
    }
}