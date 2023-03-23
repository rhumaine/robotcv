<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\CompetenceCle;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    #[IsGranted('ROLE_USER')]
    public function index(ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils): Response
    { 
        $lastUsername = $authenticationUtils->getLastUsername();
        $utilisateur = $doctrine->getRepository(Utilisateur::class)->findOneBy(array('username' => $lastUsername));
        $rolesUser = $utilisateur->getRoles();
        
        foreach($rolesUser as $r){
            if($r == "ROLE_ADMIN"){
                $role = "ROLE_ADMIN";
            }else{
                $role = "ROLE_USER";
            }
        }
        
        if($role == "ROLE_ADMIN"){
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
        }else{
            return $this->redirectToRoute('candidat_edit_profil');
        }
    }
}