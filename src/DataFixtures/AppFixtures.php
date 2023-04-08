<?php

namespace App\DataFixtures;

use App\Repository\ProduitRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Planning;
use App\Entity\Categorie;
use Faker\Provider\Lorem;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {

        // Création des catégories des produits et des plannings avec des boucles imbriquées

        $continents = array('Europe', 'Asie', 'Amériques', 'Océanie', 'Afrique');
        $faker = Faker\Factory::create('fr_FR');

        foreach ($continents as $key => $nom) {

            $category = new Categorie();
            $category->setNom($nom);
            $category->setDescription($faker->sentence(6, true));

            for ($i = 0; $i < mt_rand(5, 10); $i++) {
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
                $product->addCategorie($category);
                // $product->setImage($faker->image('/images',640,480, true));

                for ($k = 1; $k < mt_rand(0, 6); $k++) {
                    $planning = new Planning();
                    $planning->setDateDepart($faker->dateTimeBetween('0 week', '+5 week'));
                    $planning->setDateFin($faker->dateTimeBetween($planning->getDateDepart(), '+8 week'));
                    $planning->setPrix(mt_rand(100, 3000));
                    $planning->setProduit($product);
                    $planning->setQuantite(mt_rand(5, 50));


                    $manager->persist($planning);
                }
                $manager->persist($product);
            }
            $manager->persist($category);
        }

        // Création du compte administrateur

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setNom('Admin');
        $admin->setPrenom('Admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $admin,
                'adminmdp'
            )
        );
        $manager->persist($admin);

        // Création des comptes employés avec des utilisateurs associés

        for ($e = 1; $e < 10; $e++) { // Employé

            $emp = new User();
            $emp->setEmail('emp' . $e . '@gmail.com');
            $emp->setNom($faker->lastName);
            $emp->setPrenom($faker->firstName);
            $emp->setRoles(['ROLE_EMP']);
            $emp->setPassword(
                $this->userPasswordHasherInterface->hashPassword(
                    $emp,
                    'employmdp'
                )
            );
            $emp->setMatricule(uniqid('EMP'.$e));
            $emp->setNomEntreprise('Ventalis');

            for ($u = 1; $u < mt_rand(0, 10); $u++) { // Users associés (de 0 à 10)
                $user = new User();
                $user->setEmail('user' .$e. $u . '@gmail.com');
                $user->setNom($faker->lastName);
                $user->setPrenom($faker->firstName);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'usermdp'));
                $user->setConseiller($emp);

                $manager->persist($user);
            }
            $manager->persist($emp);
        }
        $manager->flush();
    }
}