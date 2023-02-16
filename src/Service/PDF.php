<?php

namespace App\Service;

use FPDF;

class PDF extends FPDF{
    
    /*-- Paramètres de la classe --*/
    /*-----------------------------*/
    protected $PROFIL;			/*-- Le nom de profil du candidat --*/
    protected $SITE;			/*-- Le site --*/
    protected $GROUPE;			/*-- Le GROUPE --*/
    protected $POSTE;			/*-- Le poste auquel postule le candidat --*/
    protected $COMPETENCES;		/*-- La liste des compétences clés du candidat --*/
    protected $ANNEES_EXP;		/*-- Le nombre d'années d'expérience du candidat --*/
    protected $DATE_ENTREE;		/*-- La date d'entre du candidat dans l'entreprise --*/
    protected $CONNAISSANCES;	/*-- La liste des connaissances techniques du candidat --*/
    protected $FORMATIONS;		/*-- La liste des formations suivies par le candidat --*/
    protected $LANGUES;			/*-- La liste des langues parlées par le candidat --*/
    protected $SAVOIR;          /*-- Savoir-etre du candidat --*/
    protected $EXPERIENCES;		/*-- La liste des expériences professionnelles du candidat --*/
    protected $CERTIFICATIONS;
    protected $WIDTH;			/*-- Position de la hauteur actuelle dans la page --*/
    protected $WIDTH_BEFORE_LANGUE;			/*-- Position de la hauteur actuelle dans la page --*/
    /*-----------------------------*/

    /*-- Constructeur de la classe --*/
    /*-------------------------------*/
    function __construct($PROFIL=NULL, $SITE=NULL, $GROUPE=NULL, $POSTE=NULL, $COMPETENCES=NULL,$SAVOIR=NULL, $ANNEES_EXP=NULL, $DATE_ENTREE=NULL, $CONNAISSANCES=NULL, $CERTIFICATIONS=NULL, $FORMATIONS=NULL, $LANGUES=NULL, $EXPERIENCES=NULL) {
        /*-- Appel constructeur classe FPDF --*/
        /*------------------------------------*/
        parent::__construct("P", "cm", "A4");
        /*------------------------------------*/

        /*-- Initialisation variables --*/
        /*------------------------------*/
        $this->PROFIL = htmlspecialchars_decode($PROFIL);
        $this->SITE = htmlspecialchars_decode($SITE);
        $this->GROUPE = htmlspecialchars_decode($GROUPE);
        $this->POSTE = htmlspecialchars_decode($POSTE);
        $this->DATE_ENTREE = htmlspecialchars_decode($DATE_ENTREE);

        $this->COMPETENCES = array();
        if ($COMPETENCES != NULL) {
            foreach ($COMPETENCES AS $COMP) {
                $this->COMPETENCES[] = htmlspecialchars_decode($COMP);
            }
        } else {
            $COMPETENCES = NULL;
        }

        $this->SAVOIR = array();
        if ($SAVOIR != NULL) {
            foreach ($SAVOIR AS $SAV) {
                $this->SAVOIR[] = htmlspecialchars_decode($SAV);
            }
        } else {
            $SAVOIR = NULL;
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
                $TITRE_EXP = htmlspecialchars_decode($EXP["Titre"]);
                $ENV = htmlspecialchars_decode($EXP["Environnement"]);

                if ($EXP["Descriptif"] != NULL) {
                    $DESC = array();
                    foreach($EXP["Descriptif"] as $EXP_DESC) {
                        $DESC[] = htmlspecialchars_decode($EXP_DESC);
                    }
                } else {
                    $DESC = NULL;
                }

                $this->EXPERIENCES[] = array("Entreprise" => $ENT, "Date_debut" => $DATE_DEBUT, "Date_fin" => $DATE_FIN, "Ville" => $VILLE, "Poste" => $EXP_POSTE, "Titre" =>$TITRE_EXP, "Descriptif" => $DESC, "Environnement" => $ENV);
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
        switch ($this->GROUPE) {
            case 1:
                $this->Image($_SERVER['DOCUMENT_ROOT'] . "/images/pdf_entete_consortia.png", 0, 0,21);
                break;
            case 2:
                $this->Image($_SERVER['DOCUMENT_ROOT'] . "/images/pdf_entete_consortis.png", 0, 0,21);
                break;
        }
        
    }
    /*------------------------------------------------*/


    /*-- Fonction pour construire le bas de page --*/
    /*---------------------------------------------*/
    function footer() {
    
        $this->SetFont("Verdana", "", 6.5);
        $this->SetTextColor(0, 0, 0);


        $this->SetY(28.8);
        $this->SetX(3.5);
      
       switch ($this->SITE) {
            case 1:
                $this->MultiCell(0, 0, utf8_decode("Consort Ouest - Atlantica 1 - Bat C - 75 rue des français libres - 44200 NANTES"));
                break;
            case 2:
                $this->MultiCell(0, 0, utf8_decode("Consort Ouest - Immeuble Oxygène - 13 rue Claude Chappe - 35510 CESSON SEVIGNE"));
                break;
            case 3:
                $this->MultiCell(0, 0, utf8_decode("Consort Ouest - La French Tech - 8 place Mgr Rumeau - 49100 ANGERS"));
                break;
            case 4:
                $this->MultiCell(0, 0, utf8_decode("Consort Group : Immeuble Cap Etoile - 58, Boulevard Gouvion-Saint-Cyr - 75858 PARIS Cedex 17"));
                break;
        }
        
        $this->SetY(29.4);
        $this->SetX(3.5);
        $this->MultiCell(0, 0, utf8_decode("Tél. : +33 1 40 88 05 05 - Fax : 33 1 40 88 19 90 - www.consort-group.com"));

    }
    /*---------------------------------------------*/


    /*-- Méthodes pour écrire les différentes parties du CV --*/
    /*--------------------------------------------------------*/
    function write_CV() {
        $this->AddPage();
        $this->write_profil();
        $this->write_poste();
        $this->write_annees_exp();
        $this->write_date_entree();
        $this->write_comp_cles();
        $this->write_langues();
        $this->write_savoir();
        $this->write_connaissances();
        $this->write_formations();
        $this->write_certifications();
        $this->write_experiences();
    }
    /*--------------------------------------------------------*/


    function write_profil() {
        if (isset($this->PROFIL) && $this->PROFIL != NULL) {
            $this->SetFont("Verdana", "", 11);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(3.4);
            $this->SetX(14.7);
            $this->MultiCell(0, 0, utf8_decode("Fiche Profil " . $this->PROFIL));
        }
    }


    function write_poste() {
        if (isset($this->POSTE) && $this->POSTE != NULL) {
            $this->SetFont("Verdana", "", 11);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(3.9);
            $this->SetX(14.7);
            $this->MultiCell(0, 0, utf8_decode($this->POSTE));

            if ($this->GetStringWidth($this->POSTE) >= 16) {
                $this->WIDTH = $this->WIDTH + (1 * intval($this->GetStringWidth($this->POSTE) / 18));
            }

            $this->WIDTH = $this->WIDTH + 5;
        }
    }


    function write_annees_exp() {
        if (isset($this->ANNEES_EXP) && $this->ANNEES_EXP != NULL) {    
            $this->SetFont("Verdana", "B", 10);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(7.2);
            $this->SetX(1.2);
            $this->MultiCell(0, 0, utf8_decode("Expérience : "));  

            $this->SetFont("Verdana", "", 10);
            $this->SetTextColor(0, 0, 0);
            $this->SetY(7.2);
            $this->SetX(4);
            if($this->ANNEES_EXP >= 2) {
                $this->MultiCell(0, 0, utf8_decode($this->ANNEES_EXP . " ans"));
            }else{
                $this->MultiCell(0, 0, utf8_decode($this->ANNEES_EXP . " an"));
            }
        }
    }

    function write_date_entree() {
        if (isset($this->DATE_ENTREE) && $this->DATE_ENTREE != NULL) {    
            $this->SetFont("Verdana", "B", 10);
            $this->SetTextColor(0, 0, 0);

            $this->SetY(7.2);
            $this->SetX(8.8);
            $this->MultiCell(0, 0, utf8_decode("Date d'entrée dans l'entreprise - "));  

            $this->SetFont("Verdana", "", 10);
            $this->SetTextColor(0, 0, 0);
            $this->SetY(7.2);
            $this->SetX(15.5);
            $this->MultiCell(0, 0, utf8_decode(date_format(date_create($this->DATE_ENTREE), 'm.Y')));
            
        }
    }

    function write_comp_cles() {
        if (isset($this->COMPETENCES) && $this->COMPETENCES != NULL) {
            $this->WIDTH = 8;
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            $this->SetY(8);
            $this->SetX(1.2);
            $this->MultiCell(4.2, 1, utf8_decode("Compétences Clés :"), 0, 1, "C", TRUE);

            $this->WIDTH = $this->WIDTH + 1.2;

            foreach($this->COMPETENCES AS $COMP) {
                $this->SetFont("Verdana", "", 10);
                $this->SetTextColor(0, 0, 0);
                $this->SetFillColor(255, 255, 255);

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

    function write_savoir() {
        if (isset($this->SAVOIR) && $this->SAVOIR != NULL) {
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            $this->SetY($this->WIDTH);
            $this->SetX(1.2);
            $this->MultiCell(2.8, 1, utf8_decode("Savoir-être :"), 0, 1, "C", TRUE);

            $this->WIDTH = $this->WIDTH + 1.2;

            foreach($this->SAVOIR AS $SAV) {
                $this->SetFont("Verdana", "" , 8);
                $this->SetTextColor(0, 0, 0);
                $this->SetFillColor(255, 255, 255);


                $TEXT_ARRAY = explode(' ', $SAV);
                $TEXT = "";

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 13.5) {
                        $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                    } else {
                        $this->SetY($this->WIDTH);
                        $this->SetX(1.2);
                        $this->MultiCell(13.5, 0.5, utf8_decode($TEXT), 0, 1, "C", TRUE);

                        $TEXT = $TEXT_ARRAY[$i];
                        $this->WIDTH = $this->WIDTH + 0.5;
                        if ($this->WIDTH > 27) {
                            $this->AddPage();
                            $this->WIDTH = 3;
                        }

                        $this->SetY($this->WIDTH);
                        $this->SetX(1.2);
                        $this->MultiCell(14.5, 0.6, "", 0, 1, "C", TRUE);
                    }
                }

                $this->SetY($this->WIDTH);
                $this->SetX(1.2);
                $this->MultiCell(13.5, 0.5, utf8_decode($TEXT), 0, 1, "C", TRUE);

                $this->WIDTH = $this->WIDTH + 0.5;
            }
        }
    }

    function write_langues() {
        $this->WIDTH_BEFORE_LANGUE =  $this->WIDTH + 1;
        if (isset($this->LANGUES)  && ($this->LANGUES != NULL)) {
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            $this->WIDTH = $this->WIDTH + 1;

            $this->SetY($this->WIDTH);
            $this->SetX(1.2);
            $this->MultiCell(4.5, 1, utf8_decode("Langues Etrangère:"), 0, 1, "C", TRUE);
            
            $this->WIDTH = $this->WIDTH + 0.5;

            $WIDTH = $this->WIDTH;


            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }


            $this->WIDTH = $this->WIDTH + 1;

            foreach ($this->LANGUES AS $LANG) {
                $this->SetFont("Verdana", "B" , 8);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH);
                $this->SetX(1.2);
                $this->MultiCell(0, 0, utf8_decode($LANG["Langue"]." : "));

                $this->SetFont("Verdana", "" , 8);
                $this->SetY($this->WIDTH);
                $this->SetX(3.5);
                $this->MultiCell(0, 0, utf8_decode($LANG["Niveau"]), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
        }
    }

    function write_connaissances() {
        if (isset($this->CONNAISSANCES) && $this->CONNAISSANCES != NULL) {
            
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            
            $this->SetY($this->WIDTH_BEFORE_LANGUE);
            $this->SetX(8.2);            
            $this->MultiCell(4.5, 1, utf8_decode("Autres Compétences:"), 0, 1, "C", TRUE);


            $WIDTH = $this->WIDTH_BEFORE_LANGUE;

            foreach ($this->CONNAISSANCES AS $CONN) {
                if ($this->GetStringWidth($CONN["Connaissances"]) > 12.5) {
                    $WIDTH = $WIDTH + (0.5 * (intval($this->GetStringWidth($CONN["Connaissances"]) / 12.5) + 1));
                } else {
                    $WIDTH = $WIDTH + 0.5;
                }
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 7.2;
            }

            /*   Transformation du tableau des autres compétences pour fusionner les domaines en doublons  */
            $donnees_fusionnees = array();
            foreach($this->CONNAISSANCES AS $CONN){

                $domaine = $CONN["Domaine"];
                $connaissance = $CONN["Connaissances"];
                if (isset($donnees_fusionnees[$domaine])) {
                    $donnees_fusionnees[$domaine] .= ", " . $connaissance;
                } else {
                    $donnees_fusionnees[$domaine] = $connaissance;
                }
            }


            $this->WIDTH = $this->WIDTH_BEFORE_LANGUE + 1.5;

            foreach ($donnees_fusionnees as $domaine => $connaissances) {
                $this->SetFont("Verdana", "B", 8);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH);
                $this->SetX(8.2);
                $this->MultiCell(0, 0, utf8_decode($domaine));

                $TEXT_ARRAY = explode(' ', $connaissances);
                $TEXT = "";

                for ($i = 0; $i < count($TEXT_ARRAY); $i++) {
                    if ($this->GetStringWidth($TEXT . $TEXT_ARRAY[$i]) < 12.5) {
                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT . $TEXT_ARRAY[$i];
                        }
                    } else {
                        $this->SetY($this->WIDTH);
                        $this->SetX(10.5);
                        $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                        if (($i + 1) < count($TEXT_ARRAY) ) {
                            $TEXT = $TEXT_ARRAY[$i] . " ";
                        } else {
                            $TEXT = $TEXT_ARRAY[$i];
                        }

                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }
                $this->SetFont("Verdana", "", 8);
                $this->SetY($this->WIDTH);
                $this->SetX(10.5);
                $this->MultiCell(0, 0, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
        }
    }

    function write_formations() {
        if (isset($this->FORMATIONS)  && ($this->FORMATIONS != NULL)) {
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            
            $this->SetY($this->WIDTH);
            $this->SetX(8.2);            
            $this->MultiCell(2.5, 1, utf8_decode("Formation:"), 0, 1, "C", TRUE);

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

            $this->WIDTH = $this->WIDTH + 1.5;

            foreach ($this->FORMATIONS AS $FORM) {
                $this->SetFont("Verdana", "B", 8);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(8.2);
                $this->MultiCell(3, 0.5, utf8_decode(date_format(date_create($FORM["Date"]), 'Y')));

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

                $this->SetFont("Verdana", "", 8);
                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(9.3);
                $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
        }
    }

    function write_certifications() {
        if (isset($this->CERTIFICATIONS) && $this->CERTIFICATIONS != NULL) {
            $this->SetFont("Verdana", "BU", 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(73, 101, 109);

            $WIDTH = $this->WIDTH;
            $WIDTH = $WIDTH + 1;
            foreach ($this->CERTIFICATIONS AS $CERT) {
                if ($this->GetStringWidth($CERT["Certification"]) > 12.5) {
                    $WIDTH = $WIDTH + (0.5 * (intval($this->GetStringWidth($CERT["Certification"]) / 12.5) + 1));
                } else {
                    $WIDTH = $WIDTH + 0.5;
                }
            }

            if ($WIDTH > 27) {
                $this->AddPage();
                $this->WIDTH = 3.5;
            }

            $this->SetY($this->WIDTH);
            $this->SetX(8.2);
            $this->MultiCell(3, 1, utf8_decode("Certifications:"), 0, 1, "C", TRUE);


            $this->WIDTH = $this->WIDTH + 1.5;

            foreach ($this->CERTIFICATIONS AS $CERT) {
                $this->SetFont("Verdana", "B", 8);
                $this->SetTextColor(0, 0, 0);

                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(8.2);
                $this->MultiCell(3, 0.5, utf8_decode(date_format(date_create($CERT["Date"]), 'Y')));

                $TEXT_ARRAY = explode(' ', $CERT["Certification"]);
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

                $this->SetFont("Verdana", "", 8);
                $this->SetY($this->WIDTH - 0.25);
                $this->SetX(9.3);
                $this->MultiCell(12.5, 0.5, utf8_decode($TEXT), 0, "L");

                $this->WIDTH = $this->WIDTH + 0.5;
            }
        }
    }

    function write_experiences() {
        if (isset($this->EXPERIENCES) && $this->EXPERIENCES != NULL) {
            $this->AddPage();
            $this->WIDTH = 6.2;

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
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFillColor(73, 101, 109);

                    if ($EXP["Date_fin"] != "") {
                        $DATE = "De " . date_format(date_create($EXP["Date_debut"]), 'm/Y') . " à " . date_format(date_create($EXP["Date_fin"]), 'm/Y');
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
                                $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L", true);

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
                        $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L", true);
                        $this->WIDTH = $this->WIDTH + 0.5;
                    } else {
                        $DATE = "Depuis " . date_format(date_create($EXP["Date_debut"]), 'm.Y'). "        ";
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
                                $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L", true);

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
                        $this->MultiCell(4.5, 0.5, utf8_decode($TEXT), 0, "L", true);
                        $this->WIDTH = $this->WIDTH + 0.5;
                    }
                }

                if ($EXP["Entreprise"] != "") {
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFillColor(73, 101, 109);
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

                    if ($EXP["Titre"] != "") {
                        $this->SetFont("Verdana", "B", 10);
                        $this->SetTextColor(0, 0, 0);
                        $this->WIDTH = $this->WIDTH + 0.75;

                        if ($this->WIDTH > 27) {
                            $this->AddPage();
                            $this->WIDTH = 3.5;
                        }

                        $this->SetY($this->WIDTH);
                        $this->SetX(2.5);
                        $this->MultiCell(0, 0, utf8_decode($EXP["Titre"]));

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