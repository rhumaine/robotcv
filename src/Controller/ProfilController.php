<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Langue;
use App\Entity\Niveau;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/create', name: 'app_profil_create')]
    public function index(ManagerRegistry $doctrine,SessionInterface $session): Response
    {
        if($session->get('email') != null){
        
            $domaines = $doctrine->getRepository(Domaine::class)->findAll();
            $langues = $doctrine->getRepository(Langue::class)->findAll();
            $niveaux = $doctrine->getRepository(Niveau::class)->findAll();

            return $this->render('profil/create.html.twig', [
                'controller_name' => 'ProfilController',
                'domaines' => $domaines,
                'langues' => $langues,
                'niveaux' => $niveaux
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }    
    }
}
