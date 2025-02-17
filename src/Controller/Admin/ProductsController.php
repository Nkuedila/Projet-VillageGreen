<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/products', name: 'admin_produits_')]


class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'app_products_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succèc');

            return $this->redirectToRoute('admin_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');



        return $this->render('admin/products/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_products_show', methods: ['GET'])]
    public function show(Produits $produit): Response
    {
        return $this->render('admin/products/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/edition/{id}', name: 'app_products_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produits $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        // on vérifie si l'utilisateur peut éditer avec le voter
        $this->denyAccessUnlessGranted('PRODUIT_EDIT', $produit);

        /*  // on divise le prix le formulaire
        $prix = $produit->getPrix() * 100;
        $produit->setPrix($prix);
 */

        return $this->render('admin/products/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/suppression/{id}', name: 'app_products_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        // on vérifie si l'utilisateur peut supprimer avec le voter
        $this->denyAccessUnlessGranted('PRODUIT_DELETE', $produit);

        return $this->redirectToRoute('admin_produits_index', [], Response::HTTP_SEE_OTHER);
    }
}
