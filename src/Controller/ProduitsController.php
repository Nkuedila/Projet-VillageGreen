<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/produits', name: 'produits_')]

class ProduitsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findAll();

        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/slug/{slug}', name: 'details')]
    public function details($slug, ProduitsRepository $produitsRepository): Response
    {

        $produit = $produitsRepository->findOneBy(['slug' => $slug]);

        if (!$produit) {
            throw $this->createNotFoundException('The product does not exist.');
        }




        return $this->render('produits/details.html.twig',  [
            'produit' => $produit,
        ]);
    }



    #[Route('/search', name: 'recherche')]
    public function search(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $searchTerm = $request->query->get('search');

        if ($searchTerm) {
            $produits = $produitsRepository->findBySearchTerm($searchTerm);
            dump($searchTerm);
            dump($produits);
        } else {
            $produits = [];
        }

        return $this->render('produits/search_results.html.twig', [
            'produits' => $produits,
        ]);
    }
}
