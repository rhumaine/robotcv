<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\CompetenceCle;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(ManagerRegistry $doctrine,SessionInterface $session): Response
    { 
            $title_page = 'Listes des profils';

            $candidats = $doctrine->getRepository(Candidat::class)->findAll();

            foreach ($candidats as $candidat) {
                // Récupérer les informations associées
                $candidatId = $candidat->getId();
                $candidatCompetencesCles = $doctrine->getRepository(CompetenceCle::class)->findOneBy(array('id_candidat' => $candidatId));

                if($candidatCompetencesCles){
                    $competence = $candidatCompetencesCles->getCompetence();
                    $candidat->competence = $competence; 
                }else{
                    $candidat->competence = null; 
                }
            }

            return $this->render('liste_profil.html.twig', [
                'title' => $title_page,
                'candidats' => $candidats
            ]); 
    }
}