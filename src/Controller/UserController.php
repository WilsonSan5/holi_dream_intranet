<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
#[IsGranted('ROLE_EMP')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {

        if ($this->getUser()->getRoles()[0] == 'ROLE_ADMIN'){
            $all_related_users = $userRepository->findUserByRole('ROLE_USER'); // findByUserRole() = method prise de stack overflow : à réviser...
        }else{
            $all_related_users = $userRepository->findBy(['conseiller' => $this->getUser()->getId()], ['conseiller' => 'ASC']); // Permet de récupérer tous les users aillant comme conseiller_id l'id de l'emp connecté
        }
        dump($all_related_users);
        return $this->render('user/index.html.twig', [
            'users' => $all_related_users,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {


        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $user->setConseiller($userRepository->findOneBy(['id' => 6]));


        
        $user->setRoles(['ROLE_USER']);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $userRepository->save($user, true);




            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/emp', name: 'app_emp_index', methods: ['GET'])]
    public function indexEmp(UserRepository $userRepository): Response
    {
        $all_emp = $userRepository->findUserByRole('ROLE_EMP');
        dump($all_emp);
        return $this->render('user/employe.html.twig', [
            'users' => $all_emp,
        ]);
    }

    #[Route('/emp/new', name: 'app_emp_new', methods: ['GET', 'POST'])]
    public function newEmp(Request $request, UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $user->setRoles(['ROLE_EMP']);
        $user->setMatricule(uniqid('EMP')); //uniqid est une fonction native PHP qui donne un serial alphanumérique en focntion de l'heure.
        // EMP va se rajouter devant


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword( // method pour crypter le mdp
                    $user,
                    $form->get('password')->getData() // récupère la valeur du champs password 
                )
            );
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_emp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/newEmp.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user, UserRepository $userRepository): Response
    {
        $all_related_users = $userRepository->findBy(array('conseiller' => $user->getId()), array('conseiller' => 'ASC')); // Permet de récupérer tous les users aillant comme conseiller_id l'id de l'emp connecté
        $role = $user->getRoles();
        $role = $role[0];
        $achats = $user->getAchat();

    

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'role' => $role,
            'achats' => $achats,
            'all_related_users' => $all_related_users
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword( // Pour encypter le mdp lorsque qu'on le modifie.
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }



}