<?php

namespace App\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/categories', name: 'categories_')]
#[ApiResource()]
class CategoriesController extends AbstractController
{
    #[Route('/slug/{slug}', name: 'list')]
    public function list($slug, Categories $category): Response
    {

        dump($category);
        // on va chercher la liste de la produits de la categories

        $produits = $category->getProduits();


        return $this->render('categories/list.html.twig', compact('category', 'produits'));
    }
}




/* #[Route('/slug/{slug}', name: 'details')]
public function details($slug, ProduitsRepository $produitsRepository): Response
{

    $produit = $produitsRepository->findOneBy(['slug' => $slug]);

    if (!$produit) {
        throw $this->createNotFoundException('The product does not exist.');
    }




    return $this->render('produits/details.html.twig',  [
        'produit' => $produit,
    ]);
 */