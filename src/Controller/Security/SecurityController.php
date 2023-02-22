<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegistrationUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app.login')]
    public function login(AuthenticationUtils $authUtils): Response
    {
        // Get the error
        $error = $authUtils->getLastAuthenticationError();

        // Get the last username connect
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,
        ]);
    }

    #[Route('/register', name: 'app.register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response|RedirectResponse{
        $user = new User();
        $form = $this->createForm(RegistrationUserType::class, $user);
        $form->handleRequest($request);
    }
}
