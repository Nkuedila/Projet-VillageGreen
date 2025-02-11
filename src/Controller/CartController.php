<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart', name: 'cart_')]

class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $panier = $session->get('panier', []);

        // on initialise des variables
        $data = [];
        $total = 0;


        foreach ($panier as $id => $quantity) {
            $produit = $produitsRepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantity' => $quantity
            ];
            $total += $produit->getPrix() * $quantity;
        }

        return $this->render('cart/index.html.twig', compact('data', 'total'));
    }


    #[Route('/add/{id}', name: 'add')]
    public function add(Produits $produit, SessionInterface $session)
    {

        // on va récupère l'id du produit
        $id = $produit->getId();

        // récupère le panier existant

        $panier = $session->get('panier', []);

        // on ajoute le produit dans le panier s'il n'y pas encore 
        // sinon on incrémente

        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        // on redirige vers la page du panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produits $produit, SessionInterface $session)
    {

        //on récupère l'id du produit 
        $id = $produit->getId();

        //on récupère le panier existant
        $panier = $session->get('panier', []);

        //on retire le produit du panier s'il n'y a qu'1 si non on incrémente sa quantité
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        // on redrige vers la page du panier 
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produits $produit, SessionInterface $session)
    {

        //on récupère l'id du produit 
        $id = $produit->getId();

        //on récupère le panier existant
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        // on redrige vers la page du panier 
        return $this->redirectToRoute('cart_index');
    }


    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('cart_index');
    }
}
