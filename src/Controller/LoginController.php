<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request, SessionInterface $session): Response
    {


        if($_POST){
            
            $email = $request->get('email');
            
            $session->set('email', $email);

            return $this->redirectToRoute('home_page');
           
        }else{
            return $this->render('login/index.html.twig', [
                'controller_name' => 'LoginController',
            ]);
        }   
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(Request $request, SessionInterface $session): Response
    {
        $session = $request->getSession();
        $session->invalidate();

        return $this->redirectToRoute('app_login');
    }
}
