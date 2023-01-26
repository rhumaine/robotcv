<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/create', name: 'app_profil_create')]
    public function index(SessionInterface $session): Response
    {
        if($session->get('email') != null){
            
           
            return $this->render('profil/index.html.twig', [
                'controller_name' => 'ProfilController',
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }    
    }
}
