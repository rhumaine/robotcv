<?php

namespace App\Service;

use FPDF;

class PDF extends FPDF{
    
    /*-- Paramètres de la classe --*/
    /*-----------------------------*/
    protected $PROFIL;			/*-- Le nom de profil du candidat --*/
    protected $POSTE;			/*-- Le poste auquel postule le candidat --*/
    protected $COMPETENCES;		/*-- La liste des compétences clés du candidat --*/
    protected $ANNEES_EXP;		/*-- Le nombre d'années d'expérience du candidat --*/
    protected $CONNAISSANCES;	/*-- La liste des connaissances techniques du candidat --*/
    protected $FORMATIONS;		/*-- La liste des formations suivies par le candidat --*/
    protected $LANGUES;			/*-- La liste des langues parlées par le candidat --*/
    protected $EXPERIENCES;		/*-- La liste des expériences professionnelles du candidat --*/
    protected $CERTIFICATIONS;
    protected $WIDTH;			/*-- Position de la hauteur actuelle dans la page --*/
    /*-----------------------------*/

    /*-- Constructeur de la classe --*/
    /*-------------------------------*/
    function __construct($PROFIL=NULL, $POSTE=NULL, $COMPETENCES=NULL, $ANNEES_EXP=NULL, $CONNAISSANCES=NULL, $CERTIFICATIONS=NULL, $FORMATIONS=NULL, $LANGUES=NULL, $EXPERIENCES=NULL) {
        /*-- Appel constructeur classe FPDF --*/
        /*------------------------------------*/
        parent::__construct("P", "cm", "A4");
        /*------------------------------------*/

        /*-- Initialisation variables --*/
        /*------------------------------*/
        $this->PROFIL = htmlspecialchars_decode($PROFIL);
        $this->POSTE = htmlspecialchars_decode($POSTE);

        $this->COMPETENCES = array();
        if ($COMPETENCES != NULL) {
            foreach ($COMPETENCES AS $COMP) {
                $this->COMPETENCES[] = htmlspecialchars_decode($COMP);
            }
        } else {
            $COMPETENCES = NULL;
        }

        $this->ANNEES_EXP = htmlspecialchars_decode($ANNEES_EXP);
    
        if ($CONNAISSANCES != NULL) {
            $this->CONNAISSANCES = array();
            foreach ($CONNAISSANCES as $CONN) {
                $this->CONNAISSANCES[] = array("Domaine" => htmlspecialchars_decode($CONN["Domaine"]), "Connaissances" => htmlspecialchars_decode($CONN["Connaissances"]));
            }
        } else {
            $this->CONNAISSANCES = NULL;
        }

        if ($CERTIFICATIONS != NULL) {
            $this->CERTIFICATIONS = array();
            foreach ($CERTIFICATIONS as $CERT) {
                $this->CERTIFICATIONS[] = array("Date" => htmlspecialchars_decode($CERT["Date"]), "Certification" => htmlspecialchars_decode($CERT["Certification"]));
            }
        } else {
            $this->CERTIFICATIONS = NULL;
        }

        if ($FORMATIONS != NULL) {
            $this->FORMATIONS = array();
            foreach ($FORMATIONS as $FORM) {
                $this->FORMATIONS[] = array("Date" => htmlspecialchars_decode($FORM["Date"]), "Formation" => htmlspecialchars_decode($FORM["Formation"]));
            }
        } else {
            $this->FORMATIONS = NULL;
        }

        if ($LANGUES != NULL) {
            $this->LANGUES = array();
            foreach ($LANGUES as $LNG) {
                $this->LANGUES[] = array("Langue" => htmlspecialchars_decode($LNG["Langue"]), "Niveau" => htmlspecialchars_decode($LNG["Niveau"]));
            }
        } else {
            $this->LANGUES = NULL;
        }

        if ($EXPERIENCES != NULL) {
            $this->EXPERIENCES = array();
            foreach ($EXPERIENCES as $EXP) {
                $ENT = htmlspecialchars_decode($EXP["Entreprise"]);
                $VILLE = htmlspecialchars_decode($EXP["Ville"]);
                $EXP_POSTE = htmlspecialchars_decode($EXP["Poste"]);
                $DATE_DEBUT = htmlspecialchars_decode($EXP["Date_debut"]);
                $DATE_FIN = htmlspecialchars_decode($EXP["Date_fin"]);
                $ENV = htmlspecialchars_decode($EXP["Environnement"]);

                if ($EXP["Descriptif"] != NULL) {
                    $DESC = array();
                    foreach($EXP["Descriptif"] as $EXP_DESC) {
                        $DESC[] = htmlspecialchars_decode($EXP_DESC);
                    }
                } else {
                    $DESC = NULL;
                }

                $this->EXPERIENCES[] = array("Entreprise" => $ENT, "Date_debut" => $DATE_DEBUT, "Date_fin" => $DATE_FIN, "Ville" => $VILLE, "Poste" => $EXP_POSTE, "Descriptif" => $DESC, "Environnement" => $ENV);
            }
        } else {
            $this->EXPERIENCES = NULL;
        }
        /*------------------------------*/

        /*-- Création Font Verdana et Verdana Gras --*/
        /*-------------------------------------------*/
        $this->AddFont('Verdana', "");
        $this->AddFont('Verdana', "B");
        /*-------------------------------------------*/
    }
    /*-------------------------------*/


    /*-- Fonction pour construire l'en-tête de page --*/
    /*------------------------------------------------*/
    function header() {
        $this->Image($_SERVER['DOCUMENT_ROOT'] . "/images/logo_consort.png", 1, 1, 6);
    }
    /*------------------------------------------------*/


    /*-- Fonction pour construire le bas de page --*/
    /*---------------------------------------------*/
    function footer() {
        if (isset($this->PROFIL)  && ($this->PROFIL != NULL)) {
            $this->SetFont("Verdana", "B" , 7.5);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(27.6);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("Profil détaillé " . $this->PROFIL));
        }

        $this->SetFont("Verdana", "", 8);
        $this->SetTextColor(0, 0, 0);

        $this->SetY(28.2);
        $this->SetX(2.5);
        $this->MultiCell(0, 0, utf8_decode("Consort NT - Atlantica 1, BAT C - 75 rue des Français Libres - 44200 Nantes"));

        $this->SetY(28.6);
        $this->SetX(2.5);
        $this->MultiCell(0, 0, utf8_decode("Consort NT - ZAC des Champs Blancs - 13, rue Claude Chappe - Immeuble Oxygène"));

        $this->SetY(29);
        $this->SetX(2.5);
        $this->MultiCell(0, 0, utf8_decode("- Bat A - 35510 Cesson-Sévigné"));

        $this->SetY(27.7);
        $this->SetX(16);
        $this->MultiCell(0, 2, "", "L");

        /*-- Affichage de la date --*/
        /*--------------------------*/
        $this->SetY(28.6);
        $this->SetX(16.6);
        $this->MultiCell(0 , 0, utf8_decode(date("j/m/Y")));
        /*--------------------------*/

        /*-- Affichage du numéro de page --*/
        /*---------------------------------*/
        $this->SetY(29);
        $this->SetX(16.4);
        $this->MultiCell(0, 0, utf8_decode("Page " . $this->PageNo() . " sur {nb}"));
        /*---------------------------------*/
    }
    /*---------------------------------------------*/


    /*-- Méthodes pour écrire les différentes parties du CV --*/
    /*--------------------------------------------------------*/
    function write_CV() {
        $this->AddPage();
        $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/premiere_page.jpeg", 17.2, 3.8, 2.7);
        $this->write_profil();
        $this->write_poste();
        $this->write_comp_cles();
        $this->write_annees_exp();
        $this->write_connaissances();
        $this->write_certifications();
        $this->write_formations();
        $this->write_langues();
        $this->write_experiences();
    }
    /*--------------------------------------------------------*/


    function write_profil() {
        $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil.png", 14.5, 1.5, 6);

        if (isset($this->PROFIL) && $this->PROFIL != NULL) {
            $this->SetFont("Verdana", "B", 12);
            $this->SetTextColor(128, 128, 128);

            $this->SetY(2.4);
            $this->SetX(15.5);
            $this->MultiCell(0, 0, utf8_decode("Fiche Profil " . $this->PROFIL));
        }
    }


    function write_poste() {
        if (isset($this->POSTE) && $this->POSTE != NULL) {
            $this->SetFont("Verdana", "", 28);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(3.5);
            $this->SetX(2);
            $this->MultiCell(16, 1, utf8_decode($this->POSTE), 0, "C");

            if ($this->GetStringWidth($this->POSTE) >= 16) {
                $this->WIDTH = $this->WIDTH + (1 * intval($this->GetStringWidth($this->POSTE) / 18));
            }

            $this->WIDTH = $this->WIDTH + 5;
        }
     }


     function write_comp_cles() {
         if (isset($this->COMPETENCES) && $this->COMPETENCES != NULL) {
             $this->SetFont("Verdana", "U", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(0, 134, 141);

            $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(14.5, 1, utf8_decode("Compétences clés :"), 0, 1, "C", TRUE);

            $this->WIDTH = $this->WIDTH + 0.85;

            foreach($this->COMPETENCES AS $COMP) {
                $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(255, 255, 255);
                $this->SetFillColor(0, 134, 141);

                $this->SetY($this->WIDTH);
                $this->SetX(2.5);
                $this->MultiCell(14.5, 0.6, "   " . chr(127), 0, 1, "C", TRUE);

                $TEXT_ARRAY = explode(' ', $COMP);
                $TEXT = "";

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13.5) {
                        $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                    } else {
                        $this->SetY($this->WIDTH);
                        $this->SetX(3.5);
                        $this->MultiCell(13.5, 0.5, utf8_decode($TEXT), 0, 1, "C", TRUE);

                        $TEXT = $TEXT_ARRAY[$i];
                        $this->WIDTH = $this->WIDTH + 0.5;
                        if ($this->WIDTH > 27) {
                            $this->AddPage();
                            $this->WIDTH = 3;
                        }

                        $this->SetY($this->WIDTH);
                        $this->SetX(2.5);
                        $this->MultiCell(14.5, 0.6, "", 0, 1, "C", TRUE);
                    }
                }

                $this->SetY($this->WIDTH);
                $this->SetX(3.5);
                $this->MultiCell(13.5, 0.5, utf8_decode($TEXT), 0, 1, "C", TRUE);

                $this->WIDTH = $this->WIDTH + 0.5;
            }
         }
     }


     function write_annees_exp() {
         if (isset($this->ANNEES_EXP) && $this->ANNEES_EXP != NULL) {
             if($this->ANNEES_EXP >= 2) {
                 $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(235, 106, 10);
                 $this->WIDTH = $this->WIDTH + 0.6;

                $this->SetY($this->WIDTH);
                $this->SetX(2.5);
                $this->MultiCell(0, 0, utf8_decode("Années d'expérience : "));

                 $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH);
                $this->SetX(6.5);
                $this->MultiCell(0, 0, utf8_decode($this->ANNEES_EXP . " ans"));
             }
         }
     }


     function write_connaissances() {
         if (isset($this->CONNAISSANCES) && $this->CONNAISSANCES != NULL) {
             $this->SetFont("Verdana", "", 14);
            $this->SetTextColor(235, 106, 10);
            $this->WIDTH = $this->WIDTH + 1.5;

            $WIDTH = $this->WIDTH;
            $WIDTH = $this->WIDTH + 1;

            foreach ($this->CONNAISSANCES AS $CONN) {
                if ($this->GetStringWidth($CONN["Connaissances"]) > 12.5) {
                    $WIDTH = $WIDTH + (0.5 * (intval($this->GetStringWidth($CONN["Connaissances"]) / 12.5) + 1));
                } else {
                    $WIDTH = $WIDTH + 0.5;
                }
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }

            $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("CONNAISSANCES TECHNIQUES"));
            $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil_2.png", 3, $this->WIDTH + 0.3, 15.5);

            $this->WIDTH = $this->WIDTH + 1;

            foreach ($this->CONNAISSANCES AS $CONN) {
                $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(2.5);
                $this->MultiCell(3, 0.5, utf8_decode($CONN["Domaine"]));

                $TEXT_ARRAY = explode(' ', $CONN["Connaissances"]);
                $TEXT = "";

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 12.5) {
                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                        }
                    } else {
                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(5.5);
                        $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT_ARRAY[$i];
                        }

                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(5.5);
                $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
         }
     }


     function write_certifications() {
         if (isset($this->CERTIFICATIONS) && $this->CERTIFICATIONS != NULL) {
            $this->SetFont("Verdana", "", 14);
            $this->SetTextColor(235, 106, 10);
            $this->WIDTH = $this->WIDTH + 1;

            $WIDTH = $this->WIDTH;
            $WIDTH = $WIDTH + 1;

            foreach ($this->CERTIFICATIONS AS $CERT) {
                if ($this->GetStringWidth($CERT["Certification"]) > 12.5) {
                    $WIDTH = $WIDTH + (0.5 * (intval($this->GetStringWidth($FORM["Certification"]) / 12.5) + 1));
                } else {
                    $WIDTH = $WIDTH + 0.5;
                }
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }

            $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("CERTIFICATIONS"));
            $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil_2.png", 3, $this->WIDTH + 0.3, 15.5);


            $this->WIDTH = $this->WIDTH + 1;

            foreach ($this->CERTIFICATIONS AS $CERT) {
                $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(2.5);
                $this->MultiCell(3, 0.5, utf8_decode($CERT["Date"]));

                $TEXT_ARRAY = explode(' ', $CERT["Certification"]);
                $TEXT = "";

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 12.5) {
                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                        }
                    } else {
                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(5.5);
                        $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT_ARRAY[$i];
                        }

                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(5.5);
                $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
         }
     }


     function write_formations() {
         if (isset($this->FORMATIONS)  && ($this->FORMATIONS != NULL)) {
             $this->SetFont("Verdana", "", 14);
            $this->SetTextColor(235, 106, 10);
            $this->WIDTH = $this->WIDTH + 1;

            $WIDTH = $this->WIDTH;
            $WIDTH = $WIDTH + 1;

            foreach ($this->FORMATIONS AS $FORM) {
                if ($this->GetStringWidth($FORM["Formation"]) > 12.5) {
                    $WIDTH = $WIDTH + (0.5 * (intval($this->GetStringWidth($FORM["Formation"]) / 12.5) + 1));
                } else {
                    $WIDTH = $WIDTH + 0.5;
                }
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }

            $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("FORMATIONS"));
            $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil_2.png", 3, $this->WIDTH + 0.3, 15.5);

            $this->WIDTH = $this->WIDTH + 1;

            foreach ($this->FORMATIONS AS $FORM) {
                $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(2.5);
                $this->MultiCell(3, 0.5, utf8_decode($FORM["Date"]));

                $TEXT_ARRAY = explode(' ', $FORM["Formation"]);
                $TEXT = "";	

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 12.5) {
                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                        }
                    } else {
                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(5.5);
                        $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT_ARRAY[$i];
                        }

                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(5.5);
                $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
         }
     }


     function write_langues() {
         if (isset($this->LANGUES)  && ($this->LANGUES != NULL)) {
             $this->SetFont("Verdana", "", 14);
            $this->SetTextColor(235, 106, 10);
            $this->WIDTH = $this->WIDTH + 1;

            $WIDTH = $this->WIDTH;
            $WIDTH = $WIDTH + 1;

            foreach ($this->LANGUES AS $LANG) {
                $WIDTH = $WIDTH + 0.5;
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }

            $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("LANGUES"));
            $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil_2.png", 3, $this->WIDTH + 0.3, 15.5);

            $this->WIDTH = $this->WIDTH + 1;

            foreach ($this->LANGUES AS $LANG) {
                $this->SetFont("Verdana", "" , 10);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH);
                $this->SetX(2.5);
                $this->MultiCell(0, 0, utf8_decode($LANG["Langue"]));

                $this->SetY($this->WIDTH);
                $this->SetX(5.5);
                $this->MultiCell(0, 0, utf8_decode($LANG["Niveau"]), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
         }
     }


     function write_experiences() {
         if (isset($this->EXPERIENCES) && $this->EXPERIENCES != NULL) {
             $this->AddPage();
             $this->WIDTH = 3.5;

             $this->SetFont("Verdana", "", 14);
             $this->SetTextColor(0, 134, 141);

             $this->SetY($this->WIDTH);
            $this->SetX(2.5);
            $this->MultiCell(0, 0, utf8_decode("EXPERIENCES PROFESIONNELLES"));
            $this->Image($_SERVER['DOCUMENT_ROOT'] . "/robotcv/public/images/profil_2.png", 3, $this->WIDTH + 0.3, 15.5);

            $this->WIDTH = $this->WIDTH + 0.5;
            $index = 0;
            foreach ($this->EXPERIENCES AS $EXP) {
                $this->WIDTH = $this->WIDTH + 1;

                $WIDTH_DATES = 0;
                if ($EXP["Date_debut"] != "") {
                    if ($EXP["Date_fin"] != "") {
                        $DATE = "De " . $EXP["Date_debut"] . " à " . $EXP["Date_fin"];
                        $TEXT_ARRAY = explode(' ', $DATE);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 4) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $TEXT = "";
                                $WIDTH_DATES = $WIDTH_DATES + 0.5;
                            }
                        }

                        $WIDTH_DATES = $WIDTH_DATES + 0.5;
                    } else {
                        $DATE = "Depuis " . $EXP["Date_debut"];
                        $TEXT_ARRAY = explode(' ', $DATE);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 4) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $TEXT = "";
                                $WIDTH_DATES = $WIDTH_DATES + 0.5;
                            }
                        }

                        $WIDTH_DATES = $WIDTH_DATES + 0.5;
                    }
                }

                $WIDTH_ENT = 0;
                if ($EXP["Entreprise"] != "") {
                    if ($EXP["Ville"] != "") {
                        $ENT = $EXP["Entreprise"] . " - " . $EXP["Ville"];
                        $TEXT_ARRAY = explode(' ', $ENT);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $TEXT = "";
                                $WIDTH_ENT = $WIDTH_ENT + 0.5;
                            }
                        }

                        $WIDTH_ENT = $WIDTH_ENT + 0.5;
                    } else {
                        $TEXT_ARRAY = explode(' ', $EXP["Entreprise"]);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $TEXT = "";
                                $WIDTH_ENT = $WIDTH_ENT + 0.5;
                            }
                        }

                        $WIDTH_ENT = $WIDTH_ENT + 0.5;
                    }
                } 

                if ($EXP["Poste"] != "") {
                    $TEXT_ARRAY = explode(' ', $EXP["Poste"]);
                    $TEXT = "";

                    for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                        if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                            if (($i + 1) < count($TEXT_ARRAY) ) {
                                $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                            } else {
                                $TEXT = $TEXT . $TEXT_ARRAY[$i];
                            }
                        } else {
                            $TEXT = "";
                            $WIDTH_ENT = $WIDTH_ENT + 0.5;
                        }
                    }

                    $WIDTH_ENT = $WIDTH_ENT + 0.5;
                }

                if ($WIDTH_ENT > $WIDTH_DATES) {
                    $WIDTH = $WIDTH_ENT;
                } else {
                    $WIDTH = $WIDTH_DATES;
                }

                $WIDTH_DESC = 0;
                if ($EXP["Descriptif"] != "") {
                    foreach ($EXP["Descriptif"] AS $DESC) {
                        $j = 0;

                        if (substr($DESC, 0, 1) == ">") {
                            if ($j != 0) {
                                $WIDTH_DESC = $WIDTH_DESC + 0.8;
                            }

                            $TEXT_ARRAY = explode(' ', substr($DESC, 2));
                            $TEXT = "";

                            for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                                if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 16) {
                                    if (($i + 1) < count($TEXT_ARRAY) ) {
                                        $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                    } else {
                                        $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                    }
                                } else {
                                    $TEXT = "";
                                    $WIDTH_DESC = $WIDTH_DESC + 0.5;
                                }
                            }

                            $WIDTH_DESC = $WIDTH_DESC + 0.5;
                        }  else {
                            $TEXT_ARRAY = explode(' ', $DESC);
                            $TEXT = "";

                            for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                                if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 16) {
                                    if (($i + 1) < count($TEXT_ARRAY) ) {
                                        $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                    } else {
                                        $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                    }
                                } else {
                                    $TEXT = "";
                                    $WIDTH_DESC = $WIDTH_DESC + 0.5;
                                }
                            }

                            $WIDTH_DESC = $WIDTH_DESC + 0.5;
                        }
                    }
                }

                $WIDTH = $WIDTH + $WIDTH_DESC;

                $WIDTH_ENV = 0;
                if ($EXP["Environnement"] != "") {
                    $TEXT_ARRAY = explode(' ', $EXP["Environnement"]);
                    $TEXT = "";

                    for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                        if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                            if (($i + 1) < count($TEXT_ARRAY) ) {
                                $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                            } else {
                                $TEXT = $TEXT . $TEXT_ARRAY[$i];
                            }
                        } else {
                            $TEXT = "";
                            $WIDTH_ENV = $WIDTH_ENV + 0.5;
                        }
                    }
                    
                    $WIDTH_ENV = $WIDTH_ENV + 0.5;
                }

                $WIDTH = $WIDTH + $WIDTH_ENV;

                if ($WIDTH + $this->WIDTH > 27 && $index != 0) {
                    $this->AddPage();
                    $this->WIDTH = 3.5;
                }

                $index++;

                $WIDTH = $this->WIDTH;
                if ($EXP["Date_debut"] != "") {
                    $this->SetFont("Verdana", "B", 10);
                    $this->SetTextColor(0 , 134, 141);

                    if ($EXP["Date_fin"] != "") {
                        $DATE = "De " . $EXP["Date_debut"] . " à " . $EXP["Date_fin"];
                        $TEXT_ARRAY = explode(' ', $DATE);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 4) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(2.5);
                                $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L");

                                $TEXT = "";
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                            }
                        }

                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(2.5);
                        $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L");
                        $this->WIDTH = $this->WIDTH + 0.5;
                    } else {
                        $DATE = "Depuis " . $EXP["Date_debut"];
                        $TEXT_ARRAY = explode(' ', $DATE);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 4) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(2.5);
                                $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L");

                                $TEXT = "";
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                            }
                        }

                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(2.5);
                        $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L");
                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }

                if ($EXP["Entreprise"] != "") {
                    $this->SetFillColor(0, 134, 141);
                    $this->SetTextColor(0, 0, 0);
                    $this->WIDTH = $WIDTH;

                    if ($EXP["Ville"] != "") {
                        $ENT = $EXP["Entreprise"] . " - " . $EXP["Ville"];
                        $TEXT_ARRAY = explode(' ', $ENT);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH + 0.25);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.1, " ", 0, 1, "C", True);

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);

                                $TEXT = "";
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                            }
                        }

                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(6.5);
                        $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);
                        $this->WIDTH = $this->WIDTH + 0.5;
                    } else {
                        $ENT = $EXP["Entreprise"];
                        $TEXT_ARRAY = explode(' ', $ENT);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH + 0.25);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.1, " ", 0, 1, "C", True);

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);

                                $TEXT = "";
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                            }
                        }

                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(6.5);
                        $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);
                        $this->WIDTH = $this->WIDTH + 0.5;
                    }

                    if ($EXP["Poste"]) {
                        $this->WIDTH = $this->WIDTH - 0.25;
                        $this->SetTextColor(255, 255, 255);

                        $this->SetY($this->WIDTH - 0.02);
                        $this->SetX(6.5);
                        $this->MultiCell(13, 0.1, " ", 0, 1, "C", True);

                        $TEXT_ARRAY = explode(' ', $EXP["Poste"]);
                        $TEXT = "";

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH + 0.5);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.1, " ", 0, 1, "C", True);

                                $this->SetY($this->WIDTH);
                                $this->SetX(6.5);
                                $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);

                                $TEXT = "";
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                            }
                        }

                        $this->SetY($this->WIDTH);
                        $this->SetX(6.5);
                        $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, 1, "C", True);
                        $this->WIDTH = $this->WIDTH + 0.5;
                    }

                    if ($EXP["Descriptif"] != "") {
                        $this->SetTextColor(0, 0, 0);
                        $this->SetFont("Verdana", "", 10);
                        $this->WIDTH = $this->WIDTH + 0.5;

                        $j = 0;

                        foreach ($EXP["Descriptif"] AS $DESC) {
                            if (substr($DESC, 0, 1) == ">") {
                                if ($j != 0) {
                                    $this->WIDTH = $this->WIDTH + 0.8;
                                }
                                if ($this->WIDTH > 27) {
                                    $this->AddPage();
                                    $this->WIDTH = 3.5;
                                }

                                $this->SetFont("Verdana", "B", 10);
                                $this->SetTextColor(0, 134, 141);

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(3.5);
                                $this->MultiCell(16, 0.5, utf8_decode(">"), 0, "L");

                                $TEXT_ARRAY = explode(' ', substr($DESC, 2));
                                $TEXT = "";

                                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 16) {
                                        if (($i + 1) < count($TEXT_ARRAY) ) {
                                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                        } else {
                                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                        }
                                    } else {
                                        $this->SetY($this->WIDTH - 0.25);
                                        $this->SetX(4.3);
                                        $this->MultiCell(16, 0.5, utf8_decode($TEXT), 0, "L");

                                        if (($i + 1) < count($TEXT_ARRAY) ) {
                                            $TEXT = $TEXT_ARRAY[$i] . " ";
                                        } else {
                                            $TEXT = $TEXT_ARRAY[$i];
                                        }

                                        $this->WIDTH = $this->WIDTH + 0.5;
                                        if ($this->WIDTH > 27) {
                                            $this->AddPage();
                                            $this->WIDTH = 3.5;
                                        }
                                    }
                                }

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(4.3);
                                $this->MultiCell(16, 0.5, utf8_decode($TEXT), 0, "L");

                                $this->WIDTH = $this->WIDTH + 0.2;
                                if ($this->WIDTH > 27) {
                                    $this->AddPage();
                                    $this->WIDTH = 3.5;
                                }
                            } else {
                                $this->SetFont("Verdana", "", 10);
                                $this->SetTextColor(0, 0, 0);
                                $this->WIDTH = $this->WIDTH + 0.5;
                                if ($this->WIDTH > 27) {
                                    $this->AddPage();
                                    $this->WIDTH = 3.5;
                                }

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(3.5);
                                $this->MultiCell(1, 0.5, chr(127), 0, "L");

                                $TEXT_ARRAY = explode(' ', $DESC);
                                $TEXT = "";

                                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 16) {
                                        if (($i + 1) < count($TEXT_ARRAY) ) {
                                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                        } else {
                                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                        }
                                    } else {
                                        $this->SetY($this->WIDTH - 0.25);
                                        $this->SetX(4.3);
                                        $this->MultiCell(16, 0.5, utf8_decode($TEXT), 0, "L");

                                        if (($i + 1) < count($TEXT_ARRAY) ) {
                                            $TEXT = $TEXT_ARRAY[$i] . " ";
                                        } else {
                                            $TEXT = $TEXT_ARRAY[$i];
                                        }

                                        $this->WIDTH = $this->WIDTH + 0.5;
                                        if ($this->WIDTH > 27) {
                                            $this->AddPage();
                                            $this->WIDTH = 3.5;
                                        }
                                    }
                                }

                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(4.3);
                                $this->MultiCell(16, 0.5, utf8_decode($TEXT), 0, "L");
                            }

                            $j++;
                        }
                    }

                    if ($EXP["Environnement"] != "") {
                        $this->SetFont("Verdana", "B", 10);
                        $this->SetTextColor(0, 0, 0);
                        $this->WIDTH = $this->WIDTH + 0.75;
                        if ($this->WIDTH > 27) {
                            $this->AddPage();
                            $this->WIDTH = 3.5;
                        }

                        $this->SetY($this->WIDTH);
                        $this->SetX(2.5);
                        $this->MultiCell(0, 0, utf8_decode("Environnement : "));

                        $this->SetFont("Verdana", "", 10);
                        $this->SetTextColor(0, 0, 0);

                        $TEXT_ARRAY = explode(' ', $EXP["Environnement"]);
                        $TEXT = "";	

                        for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                            if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13) {
                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT . $TEXT_ARRAY[$i];
                                }
                            } else {
                                $this->SetY($this->WIDTH - 0.25);
                                $this->SetX(5.9);
                                $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, "L");

                                if (($i + 1) < count($TEXT_ARRAY) ) {
                                    $TEXT = $TEXT_ARRAY[$i] . " ";
                                } else {
                                    $TEXT = $TEXT_ARRAY[$i];
                                }

                                $this->WIDTH = $this->WIDTH + 0.5;
                                if ($this->WIDTH > 27) {
                                    $this->AddPage();
                                    $this->WIDTH = 3.5;
                                }
                            }
                        }

                        $this->SetY($this->WIDTH - 0.25);
                        $this->SetX(5.9);
                        $this->MultiCell(13, 0.5, utf8_decode($TEXT), 0, "L");
                    }
                }
            }
        }
     }
}