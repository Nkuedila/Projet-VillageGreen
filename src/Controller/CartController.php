<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Entity\Produits;
use App\Entity\Users;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
/* use Symfony\Component\HttpFoundation\Request;
 */use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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


        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
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


    // Pour checkout et le paiement


    #[Route('/checkout', name: 'checkout')]
    public function checkout(Security $security): Response
    {
        $user = $security->getUser();

        // ✅ verifier si l'utilisateur est connecter si oui il passe la commande si non il doit se connecter 
        if (!$user instanceof Users) {
            $this->addFlash('error', 'Vous devez être connecté pour valider votre panier.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('cart/checkout.html.twig', [
            'user' => $user,
            'stripePublicKey' => $_ENV['STRIPE_PUBLIC_KEY']
        ]);
    }

    #[Route('/create-checkout-session', name: 'stripe_checkout')]
    public function createCheckoutSession(
        SessionInterface $session,
        ProduitsRepository $produitsRepository,
        EntityManagerInterface $entityManager,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user instanceof Users) {
            return new JsonResponse(['error' => 'Vous devez être connecté.'], 401);
        }

        $panier = $session->get('panier', []);
        if (empty($panier)) {
            return new JsonResponse(['error' => 'Votre panier est vide.'], 400);
        }

        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        $lineItems = [];

        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);
            if ($produit) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => ['name' => $produit->getNom()],
                        'unit_amount' => $produit->getPrix(), // ✅ Convert to cents
                    ],
                    'quantity' => $quantite,
                ];
            }
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $this->generateUrl('cart_commande', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('cart_checkout', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return new JsonResponse(['id' => $checkoutSession->id]);
    }

    // Pour Commande 

    #[Route('/commande', name: 'commande')]
    public function createCommande(
        SessionInterface $session,
        ProduitsRepository $produitsRepository,
        EntityManagerInterface $entityManager,
        Security $security,
        MailerInterface $mailer // ✅ Inject MailerInterface

    ): Response {
        $user = $security->getUser();

        // ✅ verifier si l'utilisateur est connecter si oui il passe la commande si non il doit se connecter 
        if (!$user instanceof Users) {
            $this->addFlash('error', 'Vous devez être connecté pour passer une commande.');
            return $this->redirectToRoute('app_login');
        }


        $panier = $session->get('panier', []);

        // ✅ verifier que le panier n'est pas vide pour passer au paiement
        if (!$panier || count($panier) === 0) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('cart_index');
        }

        // ✅ Calculer le total avant de passer au paiemennt 
        $total = 0;
        $reduction = ($user->getNumeroSiret() !== null) ? 0.50 : 0.0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);
            if ($produit) {
                $price = $produit->getPrix() / 100;
                if ($reduction > 0) {
                    $price *= (1 - $reduction);
                }
                $total += $price * $quantite;
            }
        }

        // ✅ Créez une commande et définissez le total AVANT de sauvegarder

        $commande = new Commande();
        $commande->setUsers($user);
        $commande->setReference(uniqid('CMD_'));
        $commande->setEtat('En cours');
        $commande->setCreatedAt(new \DateTimeImmutable());
        $commande->setDateFacture(new \DateTime());
        $commande->setAdresseFacture($user->getAdresse() ?? 'Adresse non spécifiée');
        $commande->setDateLivraison(new \DateTime('+3 days'));
        $commande->setAdresseLivraison($user->getAdresse() ?? 'Adresse non spécifiée');
        $commande->setdatePaiement(new \DateTime());
        $commande->setCoefficient(1.0);
        $commande->setTotal($total);
        $commande->setReduction(0); // ✅ Correctif : assurez-vous que la « réduction » est toujours définie
        // ✅ Définir le total avant de persister
        $entityManager->persist($commande);

        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);
            if ($produit) {
                $price = $produit->getPrix();
                if ($reduction > 0) {
                    $price *= (1 - $reduction);
                }

                $DetailsCommande = new DetailsCommande();
                $DetailsCommande->setCommande($commande);
                $DetailsCommande->setProduits($produit);
                $DetailsCommande->setQuantite($quantite);
                $DetailsCommande->setPrix($price);

                $entityManager->persist($DetailsCommande);
            }
        }


        // ✅ ici on peut soumettre sa commande cart tout est correcte
        $entityManager->flush();


    // ✅ Envoyer l'email de confirmation après la commande
    $email = (new Email())
    ->from('no-reply@votresite.com')
    ->to($user->getEmail())
    ->subject('Confirmation de votre commande')
    ->html($this->renderView('emails/commande_confirmation.html.twig', [
        'user' => $user,
        'commande' => $commande,
        'panier' => $panier,
    ]));

$mailer->send($email);




        // ✅ rediriger ver la page de commande
        $session->remove('panier');

        $this->addFlash('success', 'Votre commande a été enregistrée avec succès.');
        return $this->redirectToRoute('cart_index');
    }
}
