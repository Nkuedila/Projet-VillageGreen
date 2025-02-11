<?php

namespace App\Controller;

use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/produits', name: 'produits_')]

class ProduitsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('produits/index.html.twig');
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Produits $produit): Response
    {


        return $this->render('produits/details.html.twig', compact('produit'));
    }
}
