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
use Symfony\Component\HttpFoundation\Request;


// Importation des bundles de paiement stripe
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


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

    
  
    #[Route('/programmes/{id}', name: 'app_programmes_show', methods: ['GET'])]
    public function show(Produit $produit, Request $request, ProduitRepository $produitRepository): Response
    {

        return $this->render('programmes/show.html.twig', [
            'produit' => $produit,

        ]);
    }

    #[Route('/programmes/{id}/payment', name: 'app_programmes_payment', methods: ['GET'])]
    public function buy(Produit $produit, UserInterface $userinterface, PlanningRepository $planningRepository): Response
    {   
        $planning = $_GET['planning'];
        $planning = $planningRepository->findOneBy(['id'=>$planning]);

        return $this->render('programmes/payment.html.twig', [   
            'produit' => $produit,
            'planning' => $planning,
            'user' => $userinterface
        ]);
    }

    #[Route('/intentPayment', name: 'app_paiement_stripe')]
    public function intentStripe(SerializerInterface $serializerInterface): JsonResponse
    {
        dump('intentpayment');
        //Insérer la clé secrète pour relier votre clé public à la clé secret
        Stripe::setApiKey('sk_test_51Mf1j1FufBPCUONNJMWBzxMnyfHa5NdSycSU0Tclj0zPTktHfwIPaaEP4R3SwfBCgtpuE6o4aIpsPgu0F1vMOH6y00kbKWYWQF');

        header('Content-type : application/json');

        try {

            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            dump($jsonObj);

            //Créer l'intention de paiment avec le prix et le device
            $paymentIntent = PaymentIntent::create([
                'amount' => $jsonObj->items[0]->prix * 100,
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'description' => 'Paiement de ' . $jsonObj->items[0]->prenom . ' ' . $jsonObj->items[0]->nom
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return $this->json([
                'clientSecret' => $output['clientSecret']
            ]);


        } catch (Error $e) {
            http_response_code(500);
            echo json_decode(['error' => $e->getMessage()]);
        }

        return $this->json([], Response::HTTP_NOT_FOUND);
    }

    #[Route('programmes/{id}/confirmation', name: 'app_programmes_confirmation')]
    public function confirm(Produit $produit, AchatRepository $achatRepository, UserInterface $userinterface, PlanningRepository $planningRepository): Response
    {
        $planning = $_GET['planning'];
        $planning = $planningRepository->findOneBy(['id' => $planning]);

        $achat = new Achat;

        $achat->setUser($userinterface);
        $achat->setProduit($produit);
        $achat->setPlanning($planning);

        $achatRepository->save($achat, true);

        return $this->render('programmes/confirmation.html.twig', [
            'produit' => $produit,
        ]);
    }
}