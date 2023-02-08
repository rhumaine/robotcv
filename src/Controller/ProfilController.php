<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Langue;
use App\Entity\Niveau;
use App\Service\PDF;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/createprofil', name: 'app_profil_create_profil')]
    public function genererPdf(Request $request, SessionInterface $session): Response
    {
        var_dump('create');
        exit;
    }

    #[Route('/genererpdf', name: 'app_profil_genererpdf')]
    public function genererPdfTest(Request $request, SessionInterface $session): Response
    {
        if($session->get('email') != null){

            $profil = $request->get('profil');
            $poste = $request->get('poste');
            $nom = $request->get('nom');
            $prenom = $request->get('prenom');
            $email = $request->get('email');
            $telephone = $request->get('telephone');
            $annees_exp = $request->get('annees_exp');
            $date_entree = $request->get('date_entree');
            $comp_cle = $request->get('comp_cle');
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
            $exp_ent_1 = $request->get('exp_ent_1');
            $nb_input_experiences = $request->get('nb_input_experiences');

            /*-- Récupération du profil --*/
            /*----------------------------*/
            if (isset($profil) && $profil  != NULL) {
                $PROFIL = htmlspecialchars($profil);
            } else {
                $PROFIL = NULL;
            }

            /*-- Récupération du nom --*/
            /*----------------------------*/
            if (isset($nom) && $nom != NULL) {
                $NOM = htmlspecialchars($nom);
            } else {
                $NOM = NULL;
            }
            /*----------------------------*/

            /*-- Récupération du prénom --*/
            /*----------------------------*/
            if (isset($prenom) && $prenom != NULL) {
                $PRENOM = htmlspecialchars($prenom);
            } else {
                $PRENOM = NULL;
            }
            /*----------------------------*/

            /*-- Récupération du email --*/
            /*----------------------------*/
            if (isset($email) && $email != NULL) {
                $EMAIL = htmlspecialchars($email);
            } else {
                $EMAIL = NULL;
            }
            /*----------------------------*/

            /*-- Récupération du téléphone --*/
            /*----------------------------*/
            if (isset($telephone) && $telephone != NULL) {
                $TELEPHONE = htmlspecialchars($telephone);
            } else {
                $TELEPHONE = NULL;
            }
            /*----------------------------*/


            /*-- Récupération du poste --*/
            /*---------------------------*/
            if (isset($poste) && $poste != NULL) {
                $POSTE = htmlspecialchars(str_replace("’", "'", $poste));
            } else {
                $POSTE = NULL;
            }
            /*---------------------------*/


            /*-- Récupération du nombre d'années d'expérience --*/
            /*--------------------------------------------------*/
            if (isset($annees_exp) && $annees_exp != NULL) {
                $ANNEES_EXP = htmlspecialchars($annees_exp);
            } else {
                $ANNEES_EXP = NULL;
            }
            /*--------------------------------------------------*/

            
            /*-- Récupération du nombre d'années d'expérience --*/
            /*--------------------------------------------------*/
            if (isset($date_entree) && $date_entree != NULL) {
                $DATE_ENTREE = $date_entree;
            } else {
                $DATE_ENTREE = NULL;
            }
            /*--------------------------------------------------*/


            /*-- Récupération des compétences clés --*/
            /*---------------------------------------*/
            if (isset($comp_cle) && $comp_cle != NULL) {
                $COMP = str_replace("’", "'", $comp_cle);
                $COMPETENCES = explode("\n", htmlspecialchars($COMP));
            } else {
                $COMPETENCES = NULL;
            }
            /*---------------------------------------*/
          
            /*-- Récupération des connaissances techniques --*/
            /*-----------------------------------------------*/
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
            /*-------------------------------------*/
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
            /*---------------------------------*/
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
            /*-----------------------------------------*/
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
            /*---------------------------------------------------*/
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



            $pdf = new PDF($PROFIL, $POSTE, $COMPETENCES, $ANNEES_EXP, $DATE_ENTREE, $CONNAISSANCES, $CERTIFICATIONS, $FORMATIONS, $LANGUES, $EXPERIENCES);

              
            $pdf->AliasNbPages();
            $pdf->write_CV();
            return $pdf->Output();

           // return null;
        }else{
            return $this->redirectToRoute('app_login');
        }    
    }

}
