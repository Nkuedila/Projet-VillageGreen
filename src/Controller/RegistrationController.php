<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        UsersAuthenticator $authenticator,
        EntityManagerInterface $entityManager,
        SendMailService $mail
    ): Response {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('password')->getData();

            // encoder le mot de passe simple
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // Valider numéroSiret pour les professionnels
            if ($user->getUserstype() && $user->getUserstype()->getNom() === 'Professionnel' && !$user->getNumeroSiret()) {
                $this->addFlash('error', 'Le numéro SIRET est obligatoire pour les professionnels.');
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form,
                ]);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // on envoie le mail 
            $mail->send(
                'no-replay@monsite.net',
                $user->getEmail(),
                'Inscription de votre compte sur le site Village Green',
                'register',
                compact('user')
            );



            // Connectez l'utilisateur manuellement
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
