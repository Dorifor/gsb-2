<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_gsb_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est connecté et essaie d'aller à la page de login, il est redirigé vers l'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_gsb_accueil');
        }

        // Retourne une erreur s'il y en a une 
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupère le dernier identifiant rentré s'il y en a un
        $lastUsername = $authenticationUtils->getLastUsername();

        // On renvoie à la vue quoi afficher, et les paramètres en plus
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_gsb_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
