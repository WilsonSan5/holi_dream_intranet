<?php

namespace App\Controller;


use App\Repository\ProduitRepository;
use App\Repository\PlanningRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

use App\Repository\AchatRepository;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Achat;
use App\Form\UserPlanningType;

use Symfony\Component\HttpFoundation\Request;



#[Route('/programmes')]
class ProgrammesController extends AbstractController
{
    #[Route('/', name: 'app_programmes')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('programmes/index.html.twig', [
            'controller_name' => 'Programmes ',
            'produits' => $produitRepository->findAll() // la méthode findAll() transforme le repository en tableau.
        ]);
    }

    #[Route('/{id}', name: 'app_programmes_show', methods: ['GET'])]
    public function show(Produit $produit,  Request $request, ProduitRepository $produitRepository): Response
    {

        return $this->render('programmes/show.html.twig', [
            'produit' => $produit,

        ]);
    }

    #[Route('/{id}/stripe', name: 'app_programmes_stripe')]
    public function buy(Produit $produit, AchatRepository $achatRepository, UserInterface $userinterface, PlanningRepository $planningRepository): Response
    {
        $planning = $_GET['planning'];
        $planning = $planningRepository->findOneBy(['id' => $planning]);

        dump($planning);
        // Comment réupérer le planning sous forme d'objet ?!

        $achat = new Achat;

        $achat->setUser($userinterface);
        $achat->setProduit($produit);
        $achat->setPlanning($planning);

        $achatRepository->save($achat, true);

        return $this->render('programmes/payment.html.twig', [
            'produit' => $produit,
        ]);
    }



}