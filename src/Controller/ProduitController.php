<?php

namespace App\Controller;

use Unsplash;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/produit')]
#[IsGranted('ROLE_EMP')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produit->setPrixTTC($produit->getPrixDefaut() * 1.2);
            $produit->setEtat(true);
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        // Affiche une photo aléatoire depuis la librarie Unsplash avec en paramètre le nom du pays
        // Il se peut qu'il n'y aucune image. Solution temporaire.

        // Unsplash\HttpClient::init([
        //     'applicationId' => 'LpweD9NpAs16oiPMyP4XmylpMuwOwOv3RnKibWyF9-w',
        //     'secret' => 'SIFMdWYkzOM-zIk7xvEJrQDOs7aQPfabVVd2EkGkdA8',
        //     'callbackUrl' => 'https://your-application.com/oauth/callback',
        //     'utmSource' => 'Ventalis'
        // ]);
        // $filters = ['query' => $produit->getTitle(), 'w' => 640, 'h' => 400];
        // $randomPhoto = Unsplash\Photo::random($filters)->toArray()['urls']['small'];
        // $produit->setImage($randomPhoto);

        $plannings = $produit->getPlanning();

        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'plannings' => $plannings

        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            if($image){

                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('produit_img_dir'), // Bouger l'image dans le bon dossier que j'ai paramétré dans services.yml

                        $newFilename // nom du fichier uploadé 
                    );
                } catch (FileException $e) {
                }
                $produit->setImage('/images/produits/'.$newFilename); // attribution du chemin
            }

            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_show', ['id' => $produit->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
