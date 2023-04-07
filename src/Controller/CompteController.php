<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\CompteEditType;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;


#[Route('/compte')]
class CompteController extends AbstractController
{


    #[Route('/', name: 'app_compte_emp')]
    public function index(): Response
    {
        return $this->render('compte/show.html.twig', [
            'controller_name' => 'CompteController',
            'user' => $this->getUser()
        ]);
    }

    #[Route('/utilisateur/edit', name: 'app_compte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserInterface $userInterface, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(CompteEditType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $userInterface->setRoles(['ROLE_USER']);
            
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_compte', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compte/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    

}
