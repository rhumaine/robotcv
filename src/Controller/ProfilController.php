<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\CandidatCertification;
use App\Entity\CandidatConnaissance;
use App\Entity\CandidatExperience;
use App\Entity\CandidatFormation;
use App\Entity\CandidatLangue;
use App\Entity\CandidatPointsMarquants;
use App\Entity\CandidatSavoirEtre;
use App\Entity\CompetenceCle;
use App\Entity\Domaine;
use App\Entity\Famille;
use App\Entity\Langue;
use App\Entity\Niveau;
use App\Entity\Site;
use App\Entity\Statut;
use App\Entity\Utilisateur;
use App\Service\Mailer as ServiceMailer;
use App\Service\PDF;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProfilController extends AbstractController
{
    // Page de création de profil
    #[Route('/create', name: 'app_profil_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(ManagerRegistry $doctrine): Response
    {  
        $sites = $doctrine->getRepository(Site::class)->findAll();
        $familles = $doctrine->getRepository(Famille::class)->findAll();
        $domaines = $doctrine->getRepository(Domaine::class)->findAll();
        $langues = $doctrine->getRepository(Langue::class)->findAll();
        $niveaux = $doctrine->getRepository(Niveau::class)->findAll();
        $statuts = $doctrine->getRepository(Statut::class)->findAll();

        return $this->render('profil/create.html.twig', [
            'controller_name' => 'ProfilController',
            'sites' => $sites,
            'domaines' => $domaines,
            'langues' => $langues,
            'niveaux' => $niveaux,
            'familles' => $familles,
            'statuts' => $statuts
        ]); 
    }

    // Fonction losqu'on clique sur créer le profil
    #[Route('/createprofil', name: 'app_profil_create_profil')]
    #[IsGranted('ROLE_USER')]
    public function creerProfil(ManagerRegistry $doctrine,Request $request): Response
    {
        $profil = $request->get('profil');
        $site = $request->get('site');
        $marque = $request->get('marque');
        $famille = $request->get('famille');
        $poste = $request->get('poste');
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $localisation = $request->get('localisation');
        $statut = $request->get('statut');
        $email = $request->get('email');
        $telephone = $request->get('telephone');
        $annees_exp = $request->get('annees_exp');
        $date_entree = $request->get('date_entree');
        $comp_cle = $request->get('comp_cle');
        $pointmarquants = $request->get('pointmarquants');
        $connaissance_1 = $request->get('connaissance_1');
        $domaine_1 = $request->get('domaine_1');
        $nb_input_connaissances = $request->get('nb_input_connaissances');
        $certification_1 = $request->get('certification_1');
        $date_cert_1 = $request->get('date_cert_1');
        $nb_input_certifications = $request->get('nb_input_certifications');
        $formation_1 = $request->get('formation_1');
        $date_form_1 = $request->get('date_form_1');
        $nb_input_formations = $request->get('nb_input_formations');
        $langue_1 = $request->get('langue_1');
        $niveau_1 = $request->get('niveau_1');
        $nb_input_langues = $request->get('nb_input_langues');
        $savoir = $request->get('savoir');
        $exp_ent_1 = $request->get('exp_ent_1');
        $nb_input_experiences = $request->get('nb_input_experiences');

        /* données */
            /*-- Récupération du profil --*/
                
                if (isset($profil) && $profil  != NULL) {
                    $PROFIL = htmlspecialchars($profil);
                } else {
                    $PROFIL = NULL;
                }

            /*-- Récupération du nom --*/
                
                if (isset($nom) && $nom != NULL) {
                    $NOM = htmlspecialchars($nom);
                } else {
                    $NOM = NULL;
                }
               

            /*-- Récupération du prénom --*/
               
                if (isset($prenom) && $prenom != NULL) {
                    $PRENOM = htmlspecialchars($prenom);
                } else {
                    $PRENOM = NULL;
                }
            
            /*-- Récupération du prénom --*/
               
                if (isset($localisation) && $localisation != NULL) {
                    $LOCALISATION = htmlspecialchars($localisation);
                } else {
                    $LOCALISATION = NULL;
                }
                

            /*-- Récupération du email --*/
            
                if (isset($email) && $email != NULL) {
                    $EMAIL = htmlspecialchars($email);
                } else {
                    $EMAIL = NULL;
                }
                

            /*-- Récupération du téléphone --*/
                
                if (isset($telephone) && $telephone != NULL) {
                    $TELEPHONE = htmlspecialchars($telephone);
                } else {
                    $TELEPHONE = NULL;
                }


            /*-- Récupération du poste --*/
            
                if (isset($poste) && $poste != NULL) {
                    $POSTE = htmlspecialchars(str_replace("’", "'", $poste));
                } else {
                    $POSTE = NULL;
                }
                


            /*-- Récupération du nombre d'années d'expérience --*/
            
                if (isset($annees_exp) && $annees_exp != NULL) {
                    $ANNEES_EXP = htmlspecialchars($annees_exp);
                } else {
                    $ANNEES_EXP = NULL;
                }
            

            /*-- Récupération de la date d'entrée du candidat --*/
            
                if (isset($date_entree) && $date_entree != NULL) {
                    $DATE_ENTREE = $date_entree;
                } else {
                    $DATE_ENTREE = NULL;
                }


            /*-- Récupération des compétences clés --*/
                if (isset($comp_cle) && $comp_cle != NULL) {
                    $COMP = str_replace("’", "'", $comp_cle);
                    $COMPETENCES = explode("\n", htmlspecialchars($COMP));
                } else {
                    $COMPETENCES = NULL;
                }

                
            /*-- Récupération des points marquants --*/
                if (isset($pointmarquants) && $comp_cle != NULL) {
                    $POINT = str_replace("’", "'", $pointmarquants);
                    $POINTSMARQUANTS = explode("\n", htmlspecialchars($POINT));
                } else {
                    $POINTSMARQUANTS = NULL;
                }

            /*-- Récupération des savoir etre --*/
                if (isset($savoir) && $savoir != NULL) {
                    $SAV = str_replace("’", "'", $savoir);
                    $SAVOIR = explode("\n", htmlspecialchars($SAV));
                } else {
                    $SAVOIR = NULL;
                }
            
            /*-- Récupération des connaissances techniques --*/
                if (isset($connaissance_1) && $connaissance_1 != NULL) {
                    if (isset($domaine_1) && $domaine_1 != NULL) {
                        $CONNAISSANCES = array();
                        $NB_CONNAISSANCES = htmlspecialchars($nb_input_connaissances);
                        $i = 1;
                        while ($i != $NB_CONNAISSANCES + 1) :
                            if (isset($_POST['connaissance_' . $i]) && $_POST['connaissance_' . $i] != NULL) {
                                if (isset($_POST['domaine_' . $i]) && $_POST['domaine_' . $i] != NULL) {
                                    $arr = explode(':', $_POST['domaine_' . $i]);
                                    $CONNAISSANCES[] = array("ID" => $arr[0],"Domaine" => htmlspecialchars($arr[1]), "Connaissances" => htmlspecialchars(str_replace("’", "'", $_POST['connaissance_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $CONNAISSANCES = NULL;
                    }
                } else {
                    $CONNAISSANCES = NULL;
                }

            /*-- Récupération des certifications --*/
                if (isset($certification_1) && $certification_1 != NULL) {
                    if (isset($date_cert_1) && $date_cert_1 != NULL) {
                        $CERTIFICATIONS = array();
                        $NB_CERTIFICATIONS = htmlspecialchars($nb_input_certifications);
                        $i = 1;
                        while ($i != $NB_CERTIFICATIONS + 1) :
                            if (isset($_POST['certification_' . $i]) && $_POST['certification_' . $i] != NULL) {
                                if (isset($_POST['date_cert_' . $i]) && $_POST['date_cert_' . $i] != NULL) {
                                    $CERTIFICATIONS[] = array("Date" => htmlspecialchars($_POST['date_cert_' . $i]), "Certification" => htmlspecialchars(str_replace("’", "'", $_POST['certification_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $CERTIFICATIONS = NULL;
                    }
                } else {
                    $CERTIFICATIONS = NULL;
                }

            /*-- Récupération des formations --*/
                if (isset($formation_1) && $formation_1 != NULL) {
                    if (isset($date_form_1) && $date_form_1 != NULL) {
                        $FORMATIONS = array();
                        $NB_FORMATIONS = htmlspecialchars($nb_input_formations);
                        $i = 1;
                        while ($i != $NB_FORMATIONS + 1) :
                            if (isset($_POST['formation_' . $i]) && $_POST['formation_' . $i] != NULL) {
                                if (isset($_POST['date_form_' . $i]) && $_POST['date_form_' . $i] != NULL) {
                                    $FORMATIONS[] = array("Date" => htmlspecialchars($_POST['date_form_' . $i]), "Formation" => htmlspecialchars(str_replace("’", "'", $_POST['formation_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $FORMATIONS = NULL;
                    }
                } else {
                    $FORMATIONS = NULL;
                }


            /*-- Récupération des langues pratiquées --*/
                if (isset($langue_1) && $langue_1 != NULL) {
                    if (isset($niveau_1) && $niveau_1 != NULL) {
                        $LANGUES = array();
                        $NB_LANGUES = htmlspecialchars($nb_input_langues);
                        $i = 1;
                        while ($i != $NB_LANGUES + 1) :
                            if (isset($_POST['langue_' . $i]) && $_POST['langue_' . $i] != NULL) {
                                if (isset($_POST['niveau_' . $i]) && $_POST['niveau_' . $i] != NULL) {
                                    $arr = explode(':', $_POST['langue_' . $i]);
                                    $arrN = explode(':', $_POST['niveau_' . $i]);
                                    $LANGUES[] = array("ID" => $arr[0],"Langue" => htmlspecialchars($arr[1]), "IDNIVEAU" => $arrN[0], "Niveau" => htmlspecialchars($arrN[1]));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $LANGUES = NULL;
                    }
                } else {
                    $LANGUES = NULL;
                }


            /*-- Récupération des expériences professionnelles --*/
                if (isset($exp_ent_1) && $exp_ent_1 != NULL) {
                    $EXPERIENCES = array();
                    $NB_EXPERIENCES = htmlspecialchars($nb_input_experiences);
                    $i = 1;
                    while ($i != $NB_EXPERIENCES + 1) :
                        $ENT = "";
                        $VILLE = "";
                        $EXP_POSTE = "";
                        $DATE_DEBUT = "";
                        $DATE_FIN = "";
                        $TITRE_EXP = "";
                        $DESC = "";
                        $ENV = "";

                        if (isset($_POST['exp_ent_' . $i]) && $_POST['exp_ent_' . $i] != NULL) {
                            $ENT = htmlspecialchars(str_replace("’", "'", $_POST['exp_ent_' . $i]));
                        }

                        if (isset($_POST['exp_ville_' . $i]) && $_POST['exp_ville_' . $i] != NULL) {
                            $VILLE = htmlspecialchars(str_replace("’", "'", $_POST['exp_ville_' . $i]));
                        }

                        if (isset($_POST['exp_poste_' . $i]) && $_POST['exp_poste_' . $i] != NULL) {
                            $EXP_POSTE = htmlspecialchars(str_replace("’", "'", $_POST['exp_poste_' . $i]));
                        }

                        if (isset($_POST['exp_date_deb_' . $i]) && $_POST['exp_date_deb_' . $i] != NULL) {
                            $DATE_DEBUT = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_deb_' . $i]));
                        }

                        if (isset($_POST['exp_date_fin_' . $i]) && $_POST['exp_date_fin_' . $i] != NULL) {
                            $DATE_FIN = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_fin_' . $i]));
                        }

                        if (isset($_POST['exp_titre_' . $i]) && $_POST['exp_titre_' . $i] != NULL) {
                            $TITRE_EXP = htmlspecialchars(str_replace("’", "'", $_POST['exp_titre_' . $i]));
                        }

                        if (isset($_POST['exp_desc_' . $i]) && $_POST['exp_desc_' . $i] != NULL) {
                            $DESC = explode("\n", htmlspecialchars(str_replace("’", "'", $_POST['exp_desc_' . $i])));
                        }

                        if (isset($_POST['exp_env_' . $i]) && $_POST['exp_env_' . $i] != NULL) {
                            $ENV = htmlspecialchars($_POST['exp_env_' . $i]);
                            $ENV = str_replace("’", "'", $ENV);
                            $ENV = str_replace("\n", ", ", $ENV);
                        }

                        $EXPERIENCES[] = array("Entreprise" => $ENT, "Date_debut" => $DATE_DEBUT, "Date_fin" => $DATE_FIN, "Ville" => $VILLE, "Poste" => $EXP_POSTE,"Titre" => $TITRE_EXP,"Descriptif" => $DESC, "Environnement" => $ENV);
                        $i++;
                    endwhile;
                } else {
                    $EXPERIENCES = NULL;
                }
        /* fin données */

        /*--------------  Candidat   --------------------*/
            $candidat = new Candidat();
            $candidat->setPrenom($PRENOM);
            $candidat->setNom($NOM);
            $candidat->setEmail($EMAIL);
            $candidat->setTelephone($TELEPHONE);
            $candidat->setPoste($POSTE);
            $candidat->setAnneesExperience($ANNEES_EXP);
            $candidat->setProfil($PROFIL);
            $candidat->setSite($site);
            $candidat->setMarque($marque);
            $candidat->setFamille($famille);
            $candidat->setLocalisation($LOCALISATION);
            $candidat->setStatut($statut);

            $date_entree = strtotime($date_entree);
            $newformat = date('Y-m-d',$date_entree);
            $date_entree = new DateTime($newformat);

            $candidat->setDateEntree($date_entree);

            $doct = $doctrine->getManager();

            $doct->persist($candidat);
            $doct->flush(); 
            $idCandidat = $candidat->getId();

        /*--------------  CompetenceCle   --------------------*/

            if ($COMPETENCES != null && isset($idCandidat)){
                $competenceCle = new CompetenceCle();
                $competenceCle->setIdCandidat($idCandidat);

                $COMPETENCESBDD = implode(';', $COMPETENCES);

                $competenceCle->setCompetence($COMPETENCESBDD);
                $doct->persist($competenceCle);
            } 
        
        /*--------------  Point marquant   --------------------*/

            if ($POINTSMARQUANTS != null && isset($idCandidat)){
                $pointsmarquant = new CandidatPointsMarquants();
                $pointsmarquant->setIdCandidat($idCandidat);

                $POINTSMARQUANTSBDD = implode(';', $POINTSMARQUANTS);

                $pointsmarquant->setPointsMarquants($POINTSMARQUANTSBDD);
                $doct->persist($pointsmarquant);
            }

        /*--------------  ConnaissanceTechnique   --------------------*/
            
            if ($CONNAISSANCES != null && isset($idCandidat)){
                foreach($CONNAISSANCES as $CONN){
                    $connaissanceTech = new CandidatConnaissance();
                    $connaissanceTech->setIdDomaine($CONN['ID']);
                    $connaissanceTech->setConnaissance($CONN['Connaissances']);
                    $connaissanceTech->setIdCandidat($idCandidat);
                    $doct->persist($connaissanceTech);
                }
            }


        /*--------------  Certification   --------------------*/

            if ($CERTIFICATIONS != null && isset($idCandidat)){
                foreach($CERTIFICATIONS as $CERTIF){
                    $certification = new CandidatCertification();
                    $certification->setIdCandidat($idCandidat);
                    $certification->setCertification($CERTIF['Certification']);
        
                    $time = strtotime($CERTIF['Date']);

                    $newformat = date('Y-m-d',$time);
                    $date = new DateTime($newformat);
                    $certification->setDate($date);
                    $doct->persist($certification);
                }
            }
            
            
        /*--------------  Formation   --------------------*/
            if ($FORMATIONS != null && isset($idCandidat)){
                foreach($FORMATIONS as $FORMA){
                    $formation = new CandidatFormation();
                    $formation->setIdCandidat($idCandidat);
                    $formation->setFormation($FORMA['Formation']);

                    $time = strtotime($FORMA['Date']);

                    $newformat = date('Y-m-d',$time);
                    $date = new DateTime($newformat);
                    $formation->setDate($date);
                    $doct->persist($formation);
                }
            }
        /*--------------  Langue   --------------------*/
            if ($LANGUES != null && isset($idCandidat)){
                foreach($LANGUES as $LANGUE){
                    $langue = new CandidatLangue();
                    $langue->setIdCandidat($idCandidat);
                    $langue->setIdLangue($LANGUE['ID']);
                    $langue->setNiveau($LANGUE['IDNIVEAU']);
                    $doct->persist($langue);
                }
            }

        /*--------------  Savoir-être   --------------------*/
            if ($SAVOIR != null && isset($idCandidat)){
                $savoirfaire = new CandidatSavoirEtre();
                $savoirfaire->setIdCandidat($idCandidat);

                $savoirfairebdd = implode(';', $SAVOIR);

                $savoirfaire->setSavoiretre($savoirfairebdd);
                $doct->persist($savoirfaire);
            }          
        /*--------------  Expérience pro   --------------------*/
            
            if ($EXPERIENCES != null && isset($idCandidat)){
                foreach($EXPERIENCES as $EXPERIENCE){
        
                    $experience = new CandidatExperience();
                    $experience->setIdCandidat($idCandidat);
                    $experience->setEntreprise($EXPERIENCE['Entreprise']);

                    
                    $timeDebut = strtotime($EXPERIENCE['Date_debut']);
                    $timeFin = strtotime($EXPERIENCE['Date_fin']);
                    $newformatDebut = date('Y-m-d',$timeDebut);
                    $newformatFin = date('Y-m-d',$timeFin);
                    $dateDebut = new DateTime($newformatDebut);
                    $dateFin = new DateTime($newformatFin);


                    $experience->setDateDebut($dateDebut);
                    $experience->setDateFin($dateFin);
                    $experience->setPoste($EXPERIENCE['Poste']);
                    $experience->setLieu($EXPERIENCE['Ville']);
                    $experience->setTitreMission($EXPERIENCE['Titre']);

                    if($EXPERIENCE['Descriptif'] ==! null){
                        $EXPDESCRIPTIF = implode(';', $EXPERIENCE['Descriptif']);
                        $experience->setDescription($EXPDESCRIPTIF);
                    }
                    
                    $experience->setEnvironnement($EXPERIENCE['Environnement']);
                    $doct->persist($experience);
                }
            }
        
         
        $doct->flush();

        return $this->redirectToRoute('home_page');
    }
    
    //Fonction d'edition d'un profil (affichage de la page)
    #[Route('profil/edit/{id}', name: 'app_profil_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function showEditionProfil(int $id, ManagerRegistry $doctrine)
    {
        // Données du candidat
        $profil = $doctrine->getRepository(Candidat::class)->find($id);
        if($profil){ 
            $candidatCompetencesCles = $doctrine->getRepository(CompetenceCle::class)->findOneBy(array('id_candidat' => $id));
            $candidatPointsMarquants = $doctrine->getRepository(CandidatPointsMarquants::class)->findOneBy(array('id_candidat' => $id));
            $candidatConnaissance = $doctrine->getRepository(CandidatConnaissance::class)->findBy(array('id_candidat' => $id));
            $candidatCertification = $doctrine->getRepository(CandidatCertification::class)->findBy(array('id_candidat' => $id));
            $candidatFormation = $doctrine->getRepository(CandidatFormation::class)->findBy(array('id_candidat' => $id));
            $candidatLangue = $doctrine->getRepository(CandidatLangue::class)->findBy(array('id_candidat' => $id));
            $candidatSavoirEtre = $doctrine->getRepository(CandidatSavoirEtre::class)->findOneBy(array('id_candidat' => $id));
            $candidatExperience = $doctrine->getRepository(CandidatExperience::class)->findBy(array('id_candidat' => $id));
            
            //Données des listes déroulantes
            $sites = $doctrine->getRepository(Site::class)->findAll();
            $familles = $doctrine->getRepository(Famille::class)->findAll();
            $domaines = $doctrine->getRepository(Domaine::class)->findAll();
            $langues = $doctrine->getRepository(Langue::class)->findAll();
            $niveaux = $doctrine->getRepository(Niveau::class)->findAll();
            $statuts = $doctrine->getRepository(Statut::class)->findAll();

            return $this->render('profil/edit.html.twig', [
                'controller_name' => 'ProfilController',
                'sites' => $sites,
                'domaines' => $domaines,
                'langues' => $langues,
                'niveaux' => $niveaux,
                'statuts' => $statuts,
                'candidat' => $profil,
                'candidatId' => $id,
                'candidatCompetencesCles' => $candidatCompetencesCles,
                'candidatPointsMarquants' => $candidatPointsMarquants,
                'candidatConnaissances' => $candidatConnaissance,
                'candidatCertifications' => $candidatCertification,
                'candidatFormations' => $candidatFormation,
                'candidatLangues' => $candidatLangue,
                'candidatSavoirEtre' => $candidatSavoirEtre,
                'candidatExperiences' => $candidatExperience,
                'familles' => $familles
            ]); 
        }else{
            return $this->redirectToRoute('home_page');
        }
    }

    // Fonction losqu'on clique sur créer le profil
    #[Route('/editprofil', name: 'app_profil_edit_profil')]
    #[IsGranted('ROLE_ADMIN')]
    public function editProfil(EntityManagerInterface $entityManager,ManagerRegistry $doctrine,Request $request): Response
    {

        $candidatId = $request->get('candidatId');

        $candidat = $entityManager->getRepository(Candidat::class)->find($candidatId);
        

        if($candidat){
            $candidatCompetencesCles = $entityManager->getRepository(CompetenceCle::class)->findOneBy(array('id_candidat' => $candidatId));
            $candidatPointsMarquants = $doctrine->getRepository(CandidatPointsMarquants::class)->findOneBy(array('id_candidat' => $candidatId));
            $candidatConnaissance = $entityManager->getRepository(CandidatConnaissance::class)->findBy(array('id_candidat' => $candidatId));
            $candidatCertification = $entityManager->getRepository(CandidatCertification::class)->findBy(array('id_candidat' => $candidatId));
            $candidatFormation = $entityManager->getRepository(CandidatFormation::class)->findBy(array('id_candidat' => $candidatId));
            $candidatLangue = $entityManager->getRepository(CandidatLangue::class)->findBy(array('id_candidat' => $candidatId));
            $candidatSavoirEtre = $entityManager->getRepository(CandidatSavoirEtre::class)->findOneBy(array('id_candidat' => $candidatId));
            $candidatExperience = $entityManager->getRepository(CandidatExperience::class)->findBy(array('id_candidat' => $candidatId));
            
            if($candidatCompetencesCles){
                $entityManager->remove($candidatCompetencesCles);
            }
            if($candidatPointsMarquants){
                $entityManager->remove($candidatPointsMarquants);
            }
           
            if($candidatConnaissance){
                foreach ($candidatConnaissance as $cConnaissance) {
                    $entityManager->remove($cConnaissance);
                }
            }
            if($candidatCertification){
                foreach ($candidatCertification as $cCertif) {
                    $entityManager->remove($cCertif);
                }
            }
            if($candidatFormation){
                foreach ($candidatFormation  as $cForm ) {
                    $entityManager->remove($cForm);
                }
            }
            if($candidatLangue){
                foreach ($candidatLangue as $cLangue) {
                    $entityManager->remove($cLangue);
                }
            }
            if($candidatSavoirEtre){
                $entityManager->remove($candidatSavoirEtre);
            }
            if($candidatExperience){
                foreach ($candidatExperience as $cExp) {
                    $entityManager->remove($cExp);
                }
            }

            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        $profil = $request->get('profil');
        $site = $request->get('site');
        $marque = $request->get('marque');
        $famille = $request->get('famille');
        $poste = $request->get('poste');
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $localisation = $request->get('localisation');
        $statut = $request->get('statut');
        $email = $request->get('email');
        $telephone = $request->get('telephone');
        $annees_exp = $request->get('annees_exp');
        $date_entree = $request->get('date_entree');
        $comp_cle = $request->get('comp_cle');
        $pointmarquants = $request->get('pointmarquants');
        $connaissance_1 = $request->get('connaissance_1');
        $domaine_1 = $request->get('domaine_1');
        $nb_input_connaissances = $request->get('nb_input_connaissances');
        $certification_1 = $request->get('certification_1');
        $date_cert_1 = $request->get('date_cert_1');
        $nb_input_certifications = $request->get('nb_input_certifications');
        $formation_1 = $request->get('formation_1');
        $date_form_1 = $request->get('date_form_1');
        $nb_input_formations = $request->get('nb_input_formations');
        $langue_1 = $request->get('langue_1');
        $niveau_1 = $request->get('niveau_1');
        $nb_input_langues = $request->get('nb_input_langues');
        $savoir = $request->get('savoir');
        $exp_ent_1 = $request->get('exp_ent_1');
        $nb_input_experiences = $request->get('nb_input_experiences');

        /* données */
            /*-- Récupération du profil --*/
           
                if (isset($profil) && $profil  != NULL) {
                    $PROFIL = htmlspecialchars($profil);
                } else {
                    $PROFIL = NULL;
                }

            /*-- Récupération du site --*/

                if (isset($groupe) && $groupe  != NULL) {
                    $GROUPE = htmlspecialchars($groupe);
                } else {
                    $GROUPE = NULL;
                }

            /*-- Récupération du nom --*/
            
                if (isset($nom) && $nom != NULL) {
                    $NOM = htmlspecialchars($nom);
                } else {
                    $NOM = NULL;
                }
                

            /*-- Récupération du prénom --*/

                if (isset($prenom) && $prenom != NULL) {
                    $PRENOM = htmlspecialchars($prenom);
                } else {
                    $PRENOM = NULL;
                }

            /*-- Récupération du prénom --*/
               
                if (isset($localisation) && $localisation != NULL) {
                    $LOCALISATION = htmlspecialchars($localisation);
                } else {
                    $LOCALISATION = NULL;
                }

            /*-- Récupération du email --*/
            
                if (isset($email) && $email != NULL) {
                    $EMAIL = htmlspecialchars($email);
                } else {
                    $EMAIL = NULL;
                }
                

            /*-- Récupération du téléphone --*/
            
                if (isset($telephone) && $telephone != NULL) {
                    $TELEPHONE = htmlspecialchars($telephone);
                } else {
                    $TELEPHONE = NULL;
                }
                

            /*-- Récupération du poste --*/
            
                if (isset($poste) && $poste != NULL) {
                    $POSTE = htmlspecialchars(str_replace("’", "'", $poste));
                } else {
                    $POSTE = NULL;
                }


            /*-- Récupération du nombre d'années d'expérience --*/

                if (isset($annees_exp) && $annees_exp != NULL) {
                    $ANNEES_EXP = htmlspecialchars($annees_exp);
                } else {
                    $ANNEES_EXP = NULL;
                }
                

            
            /*-- Récupération de la date d'entrée du candidat --*/
            
                if (isset($date_entree) && $date_entree != NULL) {
                    $DATE_ENTREE = $date_entree;
                } else {
                    $DATE_ENTREE = NULL;
                }
                

            /*-- Récupération des compétences clés --*/
            
                if (isset($comp_cle) && $comp_cle != NULL) {
                    $COMP = str_replace("’", "'", $comp_cle);
                    $COMPETENCES = explode("\n", htmlspecialchars($COMP));
                } else {
                    $COMPETENCES = NULL;
                }

            /*-- Récupération des points marquants --*/
                if (isset($pointmarquants) && $comp_cle != NULL) {
                    $POINT = str_replace("’", "'", $pointmarquants);
                    $POINTSMARQUANTS = explode("\n", htmlspecialchars($POINT));
                } else {
                    $POINTSMARQUANTS = NULL;
                }
                

            /*-- Récupération des savoir etre --*/
            
                if (isset($savoir) && $savoir != NULL) {
                    $SAV = str_replace("’", "'", $savoir);
                    $SAVOIR = explode("\n", htmlspecialchars($SAV));
                } else {
                    $SAVOIR = NULL;
                }
                
            
            /*-- Récupération des connaissances techniques --*/
            
                if (isset($connaissance_1) && $connaissance_1 != NULL) {
                    if (isset($domaine_1) && $domaine_1 != NULL) {
                        $CONNAISSANCES = array();
                        $NB_CONNAISSANCES = htmlspecialchars($nb_input_connaissances);
                        $i = 1;
                        while ($i != $NB_CONNAISSANCES + 1) :
                            if (isset($_POST['connaissance_' . $i]) && $_POST['connaissance_' . $i] != NULL) {
                                if (isset($_POST['domaine_' . $i]) && $_POST['domaine_' . $i] != NULL) {
                                    $arr = explode(':', $_POST['domaine_' . $i]);
                                    $CONNAISSANCES[] = array("ID" => $arr[0],"Domaine" => htmlspecialchars($arr[1]), "Connaissances" => htmlspecialchars(str_replace("’", "'", $_POST['connaissance_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $CONNAISSANCES = NULL;
                    }
                } else {
                    $CONNAISSANCES = NULL;
                }

            /*-- Récupération des certifications --*/
            
                if (isset($certification_1) && $certification_1 != NULL) {
                    if (isset($date_cert_1) && $date_cert_1 != NULL) {
                        $CERTIFICATIONS = array();
                        $NB_CERTIFICATIONS = htmlspecialchars($nb_input_certifications);
                        $i = 1;
                        while ($i != $NB_CERTIFICATIONS + 1) :
                            if (isset($_POST['certification_' . $i]) && $_POST['certification_' . $i] != NULL) {
                                if (isset($_POST['date_cert_' . $i]) && $_POST['date_cert_' . $i] != NULL) {
                                    $CERTIFICATIONS[] = array("Date" => htmlspecialchars($_POST['date_cert_' . $i]), "Certification" => htmlspecialchars(str_replace("’", "'", $_POST['certification_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $CERTIFICATIONS = NULL;
                    }
                } else {
                    $CERTIFICATIONS = NULL;
                }

            /*-- Récupération des formations --*/
            
                if (isset($formation_1) && $formation_1 != NULL) {
                    if (isset($date_form_1) && $date_form_1 != NULL) {
                        $FORMATIONS = array();
                        $NB_FORMATIONS = htmlspecialchars($nb_input_formations);
                        $i = 1;
                        while ($i != $NB_FORMATIONS + 1) :
                            if (isset($_POST['formation_' . $i]) && $_POST['formation_' . $i] != NULL) {
                                if (isset($_POST['date_form_' . $i]) && $_POST['date_form_' . $i] != NULL) {
                                    $FORMATIONS[] = array("Date" => htmlspecialchars($_POST['date_form_' . $i]), "Formation" => htmlspecialchars(str_replace("’", "'", $_POST['formation_' . $i])));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $FORMATIONS = NULL;
                    }
                } else {
                    $FORMATIONS = NULL;
                }


            /*-- Récupération des langues pratiquées --*/
            
                if (isset($langue_1) && $langue_1 != NULL) {
                    if (isset($niveau_1) && $niveau_1 != NULL) {
                        $LANGUES = array();
                        $NB_LANGUES = htmlspecialchars($nb_input_langues);
                        $i = 1;
                        while ($i != $NB_LANGUES + 1) :
                            if (isset($_POST['langue_' . $i]) && $_POST['langue_' . $i] != NULL) {
                                if (isset($_POST['niveau_' . $i]) && $_POST['niveau_' . $i] != NULL) {
                                    $arr = explode(':', $_POST['langue_' . $i]);
                                    $arrN = explode(':', $_POST['niveau_' . $i]);
                                    $LANGUES[] = array("ID" => $arr[0],"Langue" => htmlspecialchars($arr[1]), "IDNIVEAU" => $arrN[0], "Niveau" => htmlspecialchars($arrN[1]));
                                }
                            }
                            $i++;
                        endwhile;
                    } else {
                        $LANGUES = NULL;
                    }
                } else {
                    $LANGUES = NULL;
                }



            /*-- Récupération des expériences professionnelles --*/
            
                if (isset($exp_ent_1) && $exp_ent_1 != NULL) {
                    $EXPERIENCES = array();
                    $NB_EXPERIENCES = htmlspecialchars($nb_input_experiences);
                    $i = 1;
                    while ($i != $NB_EXPERIENCES + 1) :
                        $ENT = "";
                        $VILLE = "";
                        $EXP_POSTE = "";
                        $DATE_DEBUT = "";
                        $DATE_FIN = "";
                        $TITRE_EXP = "";
                        $DESC = "";
                        $ENV = "";

                        if (isset($_POST['exp_ent_' . $i]) && $_POST['exp_ent_' . $i] != NULL) {
                            $ENT = htmlspecialchars(str_replace("’", "'", $_POST['exp_ent_' . $i]));
                        }

                        if (isset($_POST['exp_ville_' . $i]) && $_POST['exp_ville_' . $i] != NULL) {
                            $VILLE = htmlspecialchars(str_replace("’", "'", $_POST['exp_ville_' . $i]));
                        }

                        if (isset($_POST['exp_poste_' . $i]) && $_POST['exp_poste_' . $i] != NULL) {
                            $EXP_POSTE = htmlspecialchars(str_replace("’", "'", $_POST['exp_poste_' . $i]));
                        }

                        if (isset($_POST['exp_date_deb_' . $i]) && $_POST['exp_date_deb_' . $i] != NULL) {
                            $DATE_DEBUT = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_deb_' . $i]));
                        }

                        if (isset($_POST['exp_date_fin_' . $i]) && $_POST['exp_date_fin_' . $i] != NULL) {
                            $DATE_FIN = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_fin_' . $i]));
                        }

                        if (isset($_POST['exp_titre_' . $i]) && $_POST['exp_titre_' . $i] != NULL) {
                            $TITRE_EXP = htmlspecialchars(str_replace("’", "'", $_POST['exp_titre_' . $i]));
                        }

                        if (isset($_POST['exp_desc_' . $i]) && $_POST['exp_desc_' . $i] != NULL) {
                            $DESC = explode("\n", htmlspecialchars(str_replace("’", "'", $_POST['exp_desc_' . $i])));
                        }

                        if (isset($_POST['exp_env_' . $i]) && $_POST['exp_env_' . $i] != NULL) {
                            $ENV = htmlspecialchars($_POST['exp_env_' . $i]);
                            $ENV = str_replace("’", "'", $ENV);
                            $ENV = str_replace("\n", ", ", $ENV);
                        }

                        $EXPERIENCES[] = array("Entreprise" => $ENT, "Date_debut" => $DATE_DEBUT, "Date_fin" => $DATE_FIN, "Ville" => $VILLE, "Poste" => $EXP_POSTE,"Titre" => $TITRE_EXP,"Descriptif" => $DESC, "Environnement" => $ENV);
                        $i++;
                    endwhile;
                } else {
                    $EXPERIENCES = NULL;
                }
                
        /* fin données */ 

        /*--------------  Candidat   --------------------*/
            $candidat = new Candidat();
            $candidat->setPrenom($PRENOM);
            $candidat->setNom($NOM);
            $candidat->setEmail($EMAIL);
            $candidat->setTelephone($TELEPHONE);
            $candidat->setPoste($POSTE);
            $candidat->setAnneesExperience($ANNEES_EXP);
            $candidat->setProfil($PROFIL);
            $candidat->setSite($site);
            $candidat->setMarque($marque);
            $candidat->setFamille($famille);
            $candidat->setLocalisation($LOCALISATION);
            $candidat->setStatut($statut);

            $date_entree = strtotime($date_entree);
            $newformat = date('Y-m-d',$date_entree);
            $date_entree = new DateTime($newformat);

            $candidat->setDateEntree($date_entree);

            $doct = $doctrine->getManager();

            $doct->persist($candidat);
            $doct->flush(); 
            $idCandidat = $candidat->getId();

        /*--------------  CompetenceCle   --------------------*/

            if ($COMPETENCES != null && isset($idCandidat)){
                $competenceCle = new CompetenceCle();
                $competenceCle->setIdCandidat($idCandidat);

                $COMPETENCESBDD = implode(';', $COMPETENCES);

                $competenceCle->setCompetence($COMPETENCESBDD);
                $doct->persist($competenceCle);
            }

        /*--------------  Point marquant   --------------------*/

            if ($POINTSMARQUANTS != null && isset($idCandidat)){
                $pointsmarquant = new CandidatPointsMarquants();
                $pointsmarquant->setIdCandidat($idCandidat);

                $POINTSMARQUANTSBDD = implode(';', $POINTSMARQUANTS);

                $pointsmarquant->setPointsMarquants($POINTSMARQUANTSBDD);
                $doct->persist($pointsmarquant);
            }


        /*--------------  ConnaissanceTechnique   --------------------*/
            
            if ($CONNAISSANCES != null && isset($idCandidat)){
                foreach($CONNAISSANCES as $CONN){
                    $connaissanceTech = new CandidatConnaissance();
                    $connaissanceTech->setIdDomaine($CONN['ID']);
                    $connaissanceTech->setConnaissance($CONN['Connaissances']);
                    $connaissanceTech->setIdCandidat($idCandidat);
                    $doct->persist($connaissanceTech);
                }
            }


        /*--------------  Certification   --------------------*/

            if ($CERTIFICATIONS != null && isset($idCandidat)){
                foreach($CERTIFICATIONS as $CERTIF){
                    $certification = new CandidatCertification();
                    $certification->setIdCandidat($idCandidat);
                    $certification->setCertification($CERTIF['Certification']);
        
                    $time = strtotime($CERTIF['Date']);

                    $newformat = date('Y-m-d',$time);
                    $date = new DateTime($newformat);
                    $certification->setDate($date);
                    $doct->persist($certification);
                }
            }
            
            
        /*--------------  Formation   --------------------*/
            if ($FORMATIONS != null && isset($idCandidat)){
                foreach($FORMATIONS as $FORMA){
                    $formation = new CandidatFormation();
                    $formation->setIdCandidat($idCandidat);
                    $formation->setFormation($FORMA['Formation']);
    
                    $time = strtotime($FORMA['Date']);
                    $newformat = date('Y-m-d',$time);
                    $date = new DateTime($newformat);
                    $formation->setDate($date);
                    $doct->persist($formation);
                }
            }
        /*--------------  Langue   --------------------*/
            if ($LANGUES != null && isset($idCandidat)){
                foreach($LANGUES as $LANGUE){
                    $langue = new CandidatLangue();
                    $langue->setIdCandidat($idCandidat);
                    $langue->setIdLangue($LANGUE['ID']);
                    $langue->setNiveau($LANGUE['IDNIVEAU']);
                    $doct->persist($langue);
                }
            }

        /*--------------  Savoir-être   --------------------*/
            if ($SAVOIR != null && isset($idCandidat)){
                $savoirfaire = new CandidatSavoirEtre();
                $savoirfaire->setIdCandidat($idCandidat);

                $savoirfairebdd = implode(';', $SAVOIR);

                $savoirfaire->setSavoiretre($savoirfairebdd);
                $doct->persist($savoirfaire);
            }          
        /*--------------  Expérience pro   --------------------*/
            
            if ($EXPERIENCES != null && isset($idCandidat)){
                foreach($EXPERIENCES as $EXPERIENCE){
        
                    $experience = new CandidatExperience();
                    $experience->setIdCandidat($idCandidat);
                    $experience->setEntreprise($EXPERIENCE['Entreprise']);

                    
                    $timeDebut = strtotime($EXPERIENCE['Date_debut']);
                    $timeFin = strtotime($EXPERIENCE['Date_fin']);
                    $newformatDebut = date('Y-m-d',$timeDebut);
                    $newformatFin = date('Y-m-d',$timeFin);
                    $dateDebut = new DateTime($newformatDebut);
                    $dateFin = new DateTime($newformatFin);


                    $experience->setDateDebut($dateDebut);
                    $experience->setDateFin($dateFin);
                    $experience->setPoste($EXPERIENCE['Poste']);
                    $experience->setLieu($EXPERIENCE['Ville']);
                    $experience->setTitreMission($EXPERIENCE['Titre']);

                    if($EXPERIENCE['Descriptif'] ==! null){
                        $EXPDESCRIPTIF = implode(';', $EXPERIENCE['Descriptif']);
                        $experience->setDescription($EXPDESCRIPTIF);
                    }
                    
                    $experience->setEnvironnement($EXPERIENCE['Environnement']);
                    $doct->persist($experience);
                }
            }
        
         
        $doct->flush();

        return $this->redirectToRoute('home_page'); 
    }

    // Fonction de suppression d'un candidat
    #[Route('profil/delete/{id}', name: 'app_profil_delete_profil')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteProfil(int $id, EntityManagerInterface $entityManager)
    {
      
       
        $candidat = $entityManager->getRepository(Candidat::class)->find($id);

        if($candidat){ 
            $candidatCompetencesCles = $entityManager->getRepository(CompetenceCle::class)->findOneBy(array('id_candidat' => $id));
            $candidatPointsMarquants = $entityManager->getRepository(CandidatPointsMarquants::class)->findOneBy(array('id_candidat' => $id));
            $candidatConnaissance = $entityManager->getRepository(CandidatConnaissance::class)->findBy(array('id_candidat' => $id));
            $candidatCertification = $entityManager->getRepository(CandidatCertification::class)->findBy(array('id_candidat' => $id));
            $candidatFormation = $entityManager->getRepository(CandidatFormation::class)->findBy(array('id_candidat' => $id));
            $candidatLangue = $entityManager->getRepository(CandidatLangue::class)->findBy(array('id_candidat' => $id));
            $candidatSavoirEtre = $entityManager->getRepository(CandidatSavoirEtre::class)->findOneBy(array('id_candidat' => $id));
            $candidatExperience = $entityManager->getRepository(CandidatExperience::class)->findBy(array('id_candidat' => $id));

            if($candidatCompetencesCles){
                $entityManager->remove($candidatCompetencesCles);
            }

            if($candidatPointsMarquants){
                $entityManager->remove($candidatPointsMarquants);
            }
           
            if($candidatConnaissance){
                foreach ($candidatConnaissance as $cConnaissance) {
                    $entityManager->remove($cConnaissance);
                }
            }

            if($candidatCertification){
                foreach ($candidatCertification as $cCertif) {
                    $entityManager->remove($cCertif);
                }
            }

            if($candidatFormation){
                foreach ($candidatFormation  as $cForm ) {
                    $entityManager->remove($cForm);
                }
            }

            if($candidatLangue){
                foreach ($candidatLangue as $cLangue) {
                    $entityManager->remove($cLangue);
                }
            }

            if($candidatSavoirEtre){
                $entityManager->remove($candidatSavoirEtre);
            }

            if($candidatExperience){
                foreach ($candidatExperience as $cExp) {
                    $entityManager->remove($cExp);
                }
            }

            $entityManager->remove($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('home_page');
        }
    }

    // Fonction lorsqu'on clique sur générer le pdf
    #[Route('/genererpdf', name: 'app_profil_genererpdf')]
    #[IsGranted('ROLE_USER')]
    public function genererPdf(Request $request)
    {

        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $site = $request->get('site');

        $departement ="44";

        switch ($site) {
            case 1:
                $departement ="44";
                break;
            case 2:
                $departement ="35";
                break;
            case 2:
                $departement ="49";
                break;
        }

        $profil = $request->get('profil');
        $marque = $request->get('marque');
        $poste = $request->get('poste');
        $annees_exp = $request->get('annees_exp');
        $date_entree = $request->get('date_entree');
        $comp_cle = $request->get('comp_cle');
        $pointmarquants = $request->get('pointmarquants');
        $connaissance_1 = $request->get('connaissance_1');
        $domaine_1 = $request->get('domaine_1');
        $nb_input_connaissances = $request->get('nb_input_connaissances');
        $certification_1 = $request->get('certification_1');
        $date_cert_1 = $request->get('date_cert_1');
        $nb_input_certifications = $request->get('nb_input_certifications');
        $formation_1 = $request->get('formation_1');
        $date_form_1 = $request->get('date_form_1');
        $nb_input_formations = $request->get('nb_input_formations');
        $langue_1 = $request->get('langue_1');
        $niveau_1 = $request->get('niveau_1');
        $nb_input_langues = $request->get('nb_input_langues');
        $savoir = $request->get('savoir');
        $exp_ent_1 = $request->get('exp_ent_1');
        $nb_input_experiences = $request->get('nb_input_experiences');

        /*-- Récupération du profil --*/
        
            if (isset($profil) && $profil  != NULL) {
                $PROFIL = htmlspecialchars($profil);
            } else {
                $PROFIL = NULL;
            }

        /*-- Récupération du site --*/
            
            if (isset($site) && $site  != NULL) {
                $SITE = htmlspecialchars($site);
            } else {
                $SITE = NULL;
            }

        /*-- Récupération du site --*/
        
            if (isset($marque) && $marque  != NULL) {
                $MARQUE = htmlspecialchars($marque);
            } else {
                $MARQUE = NULL;
            }

        /*-- Récupération du poste --*/
        
            if (isset($poste) && $poste != NULL) {
                $POSTE = htmlspecialchars(str_replace("’", "'", $poste));
            } else {
                $POSTE = NULL;
            }
            

        /*-- Récupération du nombre d'années d'expérience --*/
        
            if (isset($annees_exp) && $annees_exp != NULL) {
                $ANNEES_EXP = htmlspecialchars($annees_exp);
            } else {
                $ANNEES_EXP = NULL;
            }
            
        
        /*-- Récupération de la date d'entrée du candidat --*/
        
            if (isset($date_entree) && $date_entree != NULL) {
                $DATE_ENTREE = $date_entree;
            } else {
                $DATE_ENTREE = NULL;
            }


        /*-- Récupération des compétences clés --*/
        
            if (isset($comp_cle) && $comp_cle != NULL) {
                $COMP = str_replace("’", "'", $comp_cle);
                $COMPETENCES = explode("\n", htmlspecialchars($COMP));
            } else {
                $COMPETENCES = NULL;
            }
            
        /*-- Récupération des points marquants --*/
            if (isset($pointmarquants) && $pointmarquants != NULL) {
                $POINT = str_replace("’", "'", $pointmarquants);
                $POINTSMARQUANTS = explode("\n", htmlspecialchars($POINT));
            } else {
                $POINTSMARQUANTS = NULL;
            }
        
        /*-- Récupération des savoir --*/
        
            if (isset($savoir) && $savoir != NULL) {
                $SAV = str_replace("’", "'", $savoir);
                $SAVOIR = explode("\n", htmlspecialchars($SAV));
            } else {
                $SAVOIR = NULL;
            }
        
        /*-- Récupération des connaissances techniques --*/
        
            if (isset($connaissance_1) && $connaissance_1 != NULL) {
                if (isset($domaine_1) && $domaine_1 != NULL) {
                    $CONNAISSANCES = array();
                    $NB_CONNAISSANCES = htmlspecialchars($nb_input_connaissances);
                    $i = 1;
                    while ($i != $NB_CONNAISSANCES + 1) :
                        if (isset($_POST['connaissance_' . $i]) && $_POST['connaissance_' . $i] != NULL) {
                            if (isset($_POST['domaine_' . $i]) && $_POST['domaine_' . $i] != NULL) {
                                $arr = explode(':', $_POST['domaine_' . $i]);
                                $CONNAISSANCES[] = array("ID" => $arr[0],"Domaine" => htmlspecialchars($arr[1]), "Connaissances" => htmlspecialchars(str_replace("’", "'", $_POST['connaissance_' . $i])));
                            }
                        }
                        $i++;
                    endwhile;
                } else {
                    $CONNAISSANCES = NULL;
                }
            } else {
                $CONNAISSANCES = NULL;
            }

        /*-- Récupération des certifications --*/
        
            if (isset($certification_1) && $certification_1 != NULL) {
                if (isset($date_cert_1) && $date_cert_1 != NULL) {
                    $CERTIFICATIONS = array();
                    $NB_CERTIFICATIONS = htmlspecialchars($nb_input_certifications);
                    $i = 1;
                    while ($i != $NB_CERTIFICATIONS + 1) :
                        if (isset($_POST['certification_' . $i]) && $_POST['certification_' . $i] != NULL) {
                            if (isset($_POST['date_cert_' . $i]) && $_POST['date_cert_' . $i] != NULL) {
                                $CERTIFICATIONS[] = array("Date" => htmlspecialchars($_POST['date_cert_' . $i]), "Certification" => htmlspecialchars(str_replace("’", "'", $_POST['certification_' . $i])));
                            }
                        }
                        $i++;
                    endwhile;
                } else {
                    $CERTIFICATIONS = NULL;
                }
            } else {
                $CERTIFICATIONS = NULL;
            }

        /*-- Récupération des formations --*/
        
            if (isset($formation_1) && $formation_1 != NULL) {
                if (isset($date_form_1) && $date_form_1 != NULL) {
                    $FORMATIONS = array();
                    $NB_FORMATIONS = htmlspecialchars($nb_input_formations);
                    $i = 1;
                    while ($i != $NB_FORMATIONS + 1) :
                        if (isset($_POST['formation_' . $i]) && $_POST['formation_' . $i] != NULL) {
                            if (isset($_POST['date_form_' . $i]) && $_POST['date_form_' . $i] != NULL) {
                                $FORMATIONS[] = array("Date" => htmlspecialchars($_POST['date_form_' . $i]), "Formation" => htmlspecialchars(str_replace("’", "'", $_POST['formation_' . $i])));
                            }
                        }
                        $i++;
                    endwhile;
                } else {
                    $FORMATIONS = NULL;
                }
            } else {
                $FORMATIONS = NULL;
            }


        /*-- Récupération des langues pratiquées --*/
        
            if (isset($langue_1) && $langue_1 != NULL) {
                if (isset($niveau_1) && $niveau_1 != NULL) {
                    $LANGUES = array();
                    $NB_LANGUES = htmlspecialchars($nb_input_langues);
                    $i = 1;
                    while ($i != $NB_LANGUES + 1) :
                        if (isset($_POST['langue_' . $i]) && $_POST['langue_' . $i] != NULL) {
                            if (isset($_POST['niveau_' . $i]) && $_POST['niveau_' . $i] != NULL) {
                                $arr = explode(':', $_POST['langue_' . $i]);
                                $arrN = explode(':', $_POST['niveau_' . $i]);
                                $LANGUES[] = array("ID" => $arr[0],"Langue" => htmlspecialchars($arr[1]), "Niveau" => htmlspecialchars($arrN[1]));
                            }
                        }
                        $i++;
                    endwhile;
                } else {
                    $LANGUES = NULL;
                }
            } else {
                $LANGUES = NULL;
            }

        /*-- Récupération des expériences professionnelles --*/
        
            if (isset($exp_ent_1) && $exp_ent_1 != NULL) {
                $EXPERIENCES = array();
                $NB_EXPERIENCES = htmlspecialchars($nb_input_experiences);
                $i = 1;
                while ($i != $NB_EXPERIENCES + 1) :
                    $ENT = "";
                    $VILLE = "";
                    $EXP_POSTE = "";
                    $DATE_DEBUT = "";
                    $DATE_FIN = "";
                    $TITRE_EXP = "";
                    $DESC = "";
                    $ENV = "";
                    
                    if (isset($_POST['exp_ent_' . $i]) && $_POST['exp_ent_' . $i] != NULL) {
                        $ENT = htmlspecialchars(str_replace("’", "'", $_POST['exp_ent_' . $i]));
                    }

                    if (isset($_POST['exp_ville_' . $i]) && $_POST['exp_ville_' . $i] != NULL) {
                        $VILLE = htmlspecialchars(str_replace("’", "'", $_POST['exp_ville_' . $i]));
                    }

                    if (isset($_POST['exp_poste_' . $i]) && $_POST['exp_poste_' . $i] != NULL) {
                        $EXP_POSTE = htmlspecialchars(str_replace("’", "'", $_POST['exp_poste_' . $i]));
                    }

                    if (isset($_POST['exp_date_deb_' . $i]) && $_POST['exp_date_deb_' . $i] != NULL) {
                        $DATE_DEBUT = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_deb_' . $i]));
                    }

                    if (isset($_POST['exp_date_fin_' . $i]) && $_POST['exp_date_fin_' . $i] != NULL) {
                        $DATE_FIN = htmlspecialchars(str_replace("’", "'", $_POST['exp_date_fin_' . $i]));
                    }

                    if (isset($_POST['exp_titre_' . $i]) && $_POST['exp_titre_' . $i] != NULL) {
                        $TITRE_EXP = htmlspecialchars(str_replace("’", "'", $_POST['exp_titre_' . $i]));
                    }

                    if (isset($_POST['exp_desc_' . $i]) && $_POST['exp_desc_' . $i] != NULL) {
                        $DESC = explode("\n", htmlspecialchars(str_replace("’", "'", $_POST['exp_desc_' . $i])));
                    }

                    if (isset($_POST['exp_env_' . $i]) && $_POST['exp_env_' . $i] != NULL) {
                        $ENV = htmlspecialchars($_POST['exp_env_' . $i]);
                        $ENV = str_replace("’", "'", $ENV);
                        $ENV = str_replace("\n", ", ", $ENV);
                    }

                    $EXPERIENCES[] = array("Entreprise" => $ENT, "Date_debut" => $DATE_DEBUT, "Date_fin" => $DATE_FIN, "Ville" => $VILLE, "Poste" => $EXP_POSTE,"Titre" => $TITRE_EXP,"Descriptif" => $DESC, "Environnement" => $ENV);
                    $i++;
                endwhile;

            } else {
                $EXPERIENCES = NULL;
            }

       
        $pdf = new PDF($PROFIL,$SITE,$MARQUE, $POSTE, $COMPETENCES, $POINTSMARQUANTS,$SAVOIR, $ANNEES_EXP, $DATE_ENTREE, $CONNAISSANCES, $CERTIFICATIONS, $FORMATIONS, $LANGUES, $EXPERIENCES);

        $pdf->AliasNbPages();
        $pdf->write_CV();

       // return $pdf->Output();   
        // Output the PDF as a response
        $response = new Response($pdf->Output($nom.'_'. $prenom.'_'.$departement.'.pdf', 'I'), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="test.pdf"',
        ]); 
        return $response;
    }





    /* TEST */

     // Page de création de profil par un utilisateur externe
     #[Route('/create/{username}/{token}', name: 'app_profil_create_by_candidat')]
     //#[IsGranted('ROLE_USER','ROLE_ADMIN')]
    public function createprofilByCandidat(string $username, string $token, ManagerRegistry $doctrine): Response
    {  
        $utilisateurExterne = $doctrine->getRepository(Utilisateur::class)->findOneBy(array('username' => $username));

        if($utilisateurExterne){
            $tokenUser = $utilisateurExterne->getToken();
            
            if($token === $tokenUser){

                // Création du token d'authentification
                $token = new UsernamePasswordToken($utilisateurExterne, null, 'main', $utilisateurExterne->getRoles());

                // Authentification de l'utilisateur
                $this->get('security.token_storage')->setToken($token);
                
                $sites = $doctrine->getRepository(Site::class)->findAll();
                $familles = $doctrine->getRepository(Famille::class)->findAll();
                $domaines = $doctrine->getRepository(Domaine::class)->findAll();
                $langues = $doctrine->getRepository(Langue::class)->findAll();
                $niveaux = $doctrine->getRepository(Niveau::class)->findAll();
                $statuts = $doctrine->getRepository(Statut::class)->findAll();
        
                return $this->render('profil/create.html.twig', [
                    'controller_name' => 'ProfilController',
                    'sites' => $sites,
                    'domaines' => $domaines,
                    'langues' => $langues,
                    'niveaux' => $niveaux,
                    'familles' => $familles,
                    'candidat' => $utilisateurExterne,
                    'statuts' => $statuts
                ]); 
            }else{
                return $this->redirectToRoute('home_page');
            }
        }
    }

 //
    #[Route('/createUser', name: 'app_profil_create_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function createUserAndEmail(Request $request, ServiceMailer $mailer): Response
    {  
        

        if ($_POST) {
            $data = $request->get('username');

            // Send email
            $mailer->sendEmail('romain.demay56@gmail.com', 'New contact form submission', $data);

            
            // Redirect to thank you page
            return $this->redirectToRoute('home_page');
        }

        return $this->render('login/create.html.twig', [
            
        ]);
    }

}
