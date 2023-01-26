<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(ManagerRegistry $doctrine,SessionInterface $session): Response
    {

        if($session->get('email') != null){
            
            $title_page = 'Listes des profils';

            $candidats = $doctrine->getRepository(Candidat::class)->findAll();
           
            return $this->render('liste_profil.html.twig', [
                'title' => $title_page,
                'candidats' => $candidats
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }
       
    }

}