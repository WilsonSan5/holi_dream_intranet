<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;


use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Planning;
use App\Entity\Categorie;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class ProductFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $categories = $manager->getRepository(Categorie::class)->findAll(); // création d'un array de catégories(objet)

        // Découpages des catégories en 3 sous groupes pour plus de cohérences. 
        $categories_1 = array_slice($categories, 1, 5);
        $categories_2 = array_slice($categories, 6, 3);
        $categories_3 = array_slice($categories, 9, 3);

        for ($i = 0; $i < 20; $i++) {

            $product = new Produit();
            $product->setTitle($faker->sentence(mt_rand(5, 10)));
            $product->setPays($faker->country());
            $product->setIntroduction($faker->sentence(6, true));
            $product->setDescription($faker->sentence(60, true));
            $product->setPrixDefaut(mt_rand(10, 50));
            $product->setDescriptionProgramme($faker->sentence(5, true));
            $product->setPrixTTC($product->getPrixDefaut() * 1.2);
            $product->setEtat(true);

            $product->addCategorie($faker->randomElement($categories_1)); // fakerPHP permet de retourner un élément d'un tableau de façon aléatoire. Il est possible de le faire avec un mt_rand()
            $product->addCategorie($faker->randomElement($categories_2));
            $product->addCategorie($faker->randomElement($categories_3));
            // Chaque produit aura 3 catégories différentes



            $product->setImage('https://placehold.co/600x400?text=' . $product->getTitle());
            // $product->setImage('/images/produits/produit (' . mt_rand(1, 28) . ').webp');


            // $product->setImage($faker->image('/images',640,480, true));

            for ($k = 1; $k < mt_rand(0, 6); $k++) {
                $planning = new Planning();

                $DateDepart = $faker->dateTimeBetween('-5 weeks', '+5 weeks');
                $DateFin = $faker->dateTimeBetween($DateDepart, $DateDepart->format('Y-m-d H:i:s') . '+3 weeks');

                $planning->setDateDepart($DateDepart);
                $planning->setDateFin($DateFin);
                // calcul de la différence de jours :
                $interval = $DateDepart->diff($DateFin);
                // Le prix est la multiplication du prix Produit et du nombre de jour
                $planning->setPrix($product->getPrixDefaut() * $interval->format("%d"));
                $planning->setProduit($product);
                $planning->setQuantite(mt_rand(5, 50));

                $manager->persist($planning);
            }
            $manager->persist($product);
        }

        $manager->flush();
    }
}