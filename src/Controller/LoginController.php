<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {

        $session = new Session();

        $session->set('email', 'tefggst');

        if($_POST){

            var_dump('ok');
            exit;
        }


        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
