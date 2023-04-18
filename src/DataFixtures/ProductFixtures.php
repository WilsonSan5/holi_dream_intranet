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

        for ($i = 0; $i < 20; $i++) {

            $product = new Produit();
            $product->setTitle($faker->country);
            $product->setIntroduction($faker->sentence(6, true));
            $product->setDescription($faker->sentence(60, true));
            $product->setNbrJour(mt_rand(7, 14));
            $product->setNbrNuit($product->getNbrJour());
            $product->setPrixDefaut(mt_rand(100, 3000));
            $product->setDescriptionProgramme($faker->sentence(5, true));
            $product->setPrixTTC($product->getPrixDefaut() * 1.2);
            $product->setEtat(true);

            for ($nbr = 1; $nbr <= mt_rand(1,3); $nbr++){
               $product->addCategorie($faker->randomElement($categories, mt_rand(1, 3)) ); //Donne 1 à 3 catégories au produit. 
            }
            

            // $product->setImage('https://placehold.co/600x400?text='.$product->getTitle());
            $product->setImage('/images/produits/produit (' . mt_rand(1, 28) . ').jpg');


            // $product->setImage($faker->image('/images',640,480, true));

            for ($k = 1; $k < mt_rand(0, 6); $k++) {
                $planning = new Planning();

                $DateDepart = $faker->dateTimeBetween('-5 weeks', '+5 weeks');
                $DateFin = $faker->dateTimeBetween($DateDepart, $DateDepart->format('Y-m-d H:i:s') . '+3 weeks');

                $planning->setDateDepart($DateDepart);
                $planning->setDateFin($DateFin);
                $planning->setPrix(mt_rand(100, 3000));
                $planning->setProduit($product);
                $planning->setQuantite(mt_rand(5, 50));


                $manager->persist($planning);
            }
            $manager->persist($product);
        }
        
        $manager->flush();
    }
}