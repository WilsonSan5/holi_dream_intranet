<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

use App\Entity\Categorie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // Création des catégories

        $categories = ['Tous', 'Europe', 'Asie', 'Amériques', 'Océanie', 'Afrique', 'plusVisités', 'bonsPlans', 'none', 'famille', 'couple', 'seul'];


        foreach ($categories as $key => $nom) {

            $category = new Categorie();
            $category->setNom($nom);
            $category->setDescription($faker->sentence(6, true));

            $manager->persist($category);

        }
        $manager->flush();
    }
}