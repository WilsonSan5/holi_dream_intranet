<?php

namespace App\Controller;


use App\Repository\ProduitRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

use App\Repository\AchatRepository;
use App\Entity\Achat;
use Symfony\Component\Security\Core\User\UserInterface;



class ProgrammesController extends AbstractController
{
    #[Route('/programmes', name: 'app_programmes')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('programmes/index.html.twig', [
            'controller_name' => 'Programmes ',
            'produits' => $produitRepository->findAll() // la méthode findAll() transforme le repository en tableau.
        ]);
    }

    #[Route('/{id}', name: 'app_programmes_show')]
    public function show( Produit $produit): Response
    {
        return $this->render('programmes/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/stripe', name: 'app_programmes_stripe')]
    public function buy( Produit $produit, AchatRepository $achatRepository, UserInterface $userinterface): Response
    {   
        $user = $userinterface;
        $achat = new Achat;
        $achat->setUser($user);

        $achatRepository->save($achat, true);

        return $this->render('programmes/payment.html.twig', [
            'produit' => $produit,
        ]);
    }

}
