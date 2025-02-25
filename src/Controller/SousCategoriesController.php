<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;




class SousCategoriesController extends AbstractController
{
    #[Route('sous/{id}', name: 'sous_categories')]
    public function list(Categories $category): Response
    {


        // foreach ($category->getCategories() as $cat) {


        // }



        return $this->render('sous_categories/index.html.twig', [
            'category' => $category
        ]);
    }
}
