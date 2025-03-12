<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;




class SousCategoriesController extends AbstractController
{
    #[Route('sous/{id}', name: 'sous_categories')]
    public function list(Categories $category): Response
    {
        return $this->render('sous_categories/index.html.twig', [
            'category' => $category
        ]);
    }

    #[Route('/sous', name: 'sous_categories_list')]
    public function sublist(CategoriesRepository $categoriesRepo): Response
    {
        $retour = '';
        $categories = $categoriesRepo->findAll();

        foreach ($categories as $cat) {
            if (!is_null($cat->getParent())) {
                $retour .= $this->renderView('sous_categories/category.html.twig', [
                    'category' => $cat
                ]);
            }
        }

        return $this->render('sous_categories/souscategories.html.twig', [
            'content' => $retour
        ]);;
    }
}
