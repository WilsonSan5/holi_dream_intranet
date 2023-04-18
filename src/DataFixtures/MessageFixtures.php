<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Messagerie;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    private $userPasswordHasherInterface;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
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
                    'empmdp'
                )
            );
            $emp->setMatricule(uniqid('EMP' . $e));
            $emp->setNomEntreprise('Ventalis');

            for ($u = 1; $u < mt_rand(0, 10); $u++) { // Users associés (de 0 à 10)
                $user = new User();
                $user->setEmail('user' . $e . $u . '@gmail.com');
                $user->setNom($faker->lastName);
                $user->setPrenom($faker->firstName);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'usermdp'));
                $user->setConseiller($emp);

                for ($o = 0; $o < mt_rand(0,2); $o++) {
                    $messagerie = new Messagerie;
                    $messagerie->setObjet($faker->sentence(mt_rand(3,10)));
                    $messagerie->addUser($user);
                    $messagerie->addUser($emp);
                    for ($m = 0; $m < mt_rand(1,10); $m++) {
                        $message = new Message;
                        $message->setContenu($faker->sentence(mt_rand(1,10)));
                        $message->setMessagerie($messagerie);
                        $message->setAuthor($messagerie->getUser()[mt_rand(0, 1)]); //à chaque création de message, 1 des 2 users en sera l'auteur.
                        $manager->persist($message);
                    }
                    $manager->persist($messagerie);
                    
                $manager->persist($user);
            }
            $manager->persist($emp);
            }
        };
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}