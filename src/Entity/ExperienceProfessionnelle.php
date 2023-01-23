<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ExperienceProfessionnelle
 *
 * @ORM\Table(name="experience_professionnelle", indexes={@ORM\Index(name="ID_Candidat", columns={"ID_Candidat"})})
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceProfessionnelleRepository")
 */
class ExperienceProfessionnelle
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Experience", type="integer", nullable=false, options={"comment"="Identifiant de l'expérience professionnelle"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="Entreprise", type="string", length=200, nullable=false, options={"comment"="Nom de l'entreprise"})
     */
    private $entreprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_debut", type="date", nullable=false, options={"comment"="Date de début de la mission"})
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Date_fin", type="date", nullable=true, options={"default"="NULL","comment"="Date de fin de la mission"})
     */
    private $dateFin = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Poste", type="string", length=200, nullable=false, options={"comment"="Poste au sein de l'entreprise"})
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu", type="string", length=200, nullable=false, options={"comment"="Lieu de la mission"})
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false, options={"comment"="Description de la mission"})
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Elements_cles", type="text", length=65535, nullable=true, options={"default"="NULL","comment"="Eléments clés de la mission"})
     */
    private $elementsCles = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Environnement", type="text", length=65535, nullable=false, options={"comment"="Description de l'environnement de travail"})
     */
    private $environnement;

    /**
     * @var \Candidat
     *
     * @ORM\ManyToOne(targetEntity="Candidat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Candidat", referencedColumnName="ID_Candidat")
     * })
     */
    private $idCandidat;

    public function getIdExperience(): ?int
    {
        return $this->idExperience;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getElementsCles(): ?string
    {
        return $this->elementsCles;
    }

    public function setElementsCles(?string $elementsCles): self
    {
        $this->elementsCles = $elementsCles;

        return $this;
    }

    public function getEnvironnement(): ?string
    {
        return $this->environnement;
    }

    public function setEnvironnement(string $environnement): self
    {
        $this->environnement = $environnement;

        return $this;
    }

    public function getIdCandidat(): ?Candidat
    {
        return $this->idCandidat;
    }

    public function setIdCandidat(?Candidat $idCandidat): self
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }


}
