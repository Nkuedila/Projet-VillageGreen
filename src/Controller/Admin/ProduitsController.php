<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/admin/produits', name: 'admin_produits_')]

class ProduitsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/produits/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/produits/index.html.twig');
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Produits $produit): Response
    {
        // on verifie si l'utilisateur peut editer avec le voter
        $this->denyAccessUnlessGranted('PRODUIT_EDIT', $produit);

        return $this->render('admin/produits/index.html.twig');
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Produits $produit): Response
    {
        // on verifie si l'utilisateur peut supprimer avec le voter
        $this->denyAccessUnlessGranted('PRODUIT_DELETE', $produit);
        return $this->render('admin/produits/index.html.twig');
    }
}
