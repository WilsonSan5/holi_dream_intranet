<?php

namespace App\Controller;

use Unsplash;
use Unsplash\HttpClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Produit;
use App\Repository\ProduitRepository;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProduitRepository $produitRepository): Response
    {

        // $produitArray = $produitRepository->findAll();
        // dump($produitArray);

        // Unsplash\HttpClient::init([
        //     'applicationId' => 'LpweD9NpAs16oiPMyP4XmylpMuwOwOv3RnKibWyF9-w',
        //     'secret' => 'SIFMdWYkzOM-zIk7xvEJrQDOs7aQPfabVVd2EkGkdA8',
        //     'callbackUrl' => 'https://your-application.com/oauth/callback',
        //     'utmSource' => 'Ventalis'
        // ]);


        // foreach ($produitArray as $key => $produit) {
        //     $filters = ['query' => $produit->getTitle(), 'w' => 640, 'h' => 400];
        //     $randomImage = Unsplash\Photo::random($filters)->toArray()['urls']['small'];
        //     $produit->setImage($randomImage);




        //     $produitRepository->save($produit, true);
        // }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',

        ]);
    }
}