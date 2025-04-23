<?php

namespace App\Controller;
use App\Entity\Users;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profil', name: 'profile_')]
class ProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        
        // If no user is logged in, redirect to login page
        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirect to login route (update with your actual login route)
        }

        // Create the form for the logged-in user
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        // If the form is submitted and valid, update the user in the database
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush(); // Persist the changes to the database
            $this->addFlash('success', 'Profile updated successfully!'); // Add success message
            return $this->redirectToRoute('profile_index'); // Redirect after successful update
        }

        // Render the profile update page
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateur', // Page title
            'form' => $form->createView(), // The form to render
        ]);
    }

    #[Route('/commandes', name: 'orders')]
    public function orders(): Response
    {
        return $this->render('profile/orders.html.twig', [
            'controller_name' => 'Commandes de l\'utilisateur', // Page title for orders
        ]);
    }
}