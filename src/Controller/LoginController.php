<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils, ?UserInterface $user): Response
    {
//        if ($user) {
//            return $this->redirectToRoute('home');
//        }
        // On récupère dernière erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();
        // on récupère dernier email utilisé pour s'authentifier
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'last_email' => $lastEmail,
            'error' => $error,
        ]);
    }
}
