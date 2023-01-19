<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Candidat
 *
 * @ORM\Table(name="candidat", uniqueConstraints={@ORM\UniqueConstraint(name="Email", columns={"Email"})}, indexes={@ORM\Index(name="ID_Recherche", columns={"ID_Recherche"})})
 * @ORM\Entity
 */
class Candidat
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Candidat", type="integer", nullable=false, options={"comment"="Identifiant du candidat"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="Profil", type="string", length=3, nullable=false)
     */
    private $profil;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=100, nullable=false, options={"comment"="Prénom du candidat"})
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=100, nullable=false, options={"comment"="Nom du candidat"})
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=200, nullable=false, options={"comment"="Email du candidat"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=10, nullable=false, options={"comment"="Téléphone du candidat"})
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Poste", type="string", length=200, nullable=false, options={"comment"="Poste auquel le candidat postule"})
     */
    private $poste;

    /**
     * @var int
     *
     * @ORM\Column(name="Annees_experience", type="integer", nullable=false, options={"comment"="Nombre d'années d'expérience du candidat"})
     */
    private $anneesExperience;

    /**
     * @var \Recherche
     *
     * @ORM\ManyToOne(targetEntity="Recherche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Recherche", referencedColumnName="ID_Recherche")
     * })
     */
    private $idRecherche;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Certification", inversedBy="idCandidat")
     * @ORM\JoinTable(name="candidat_certification",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Candidat", referencedColumnName="ID_Candidat")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Certification", referencedColumnName="ID_Certification")
     *   }
     * )
     */
    private $idCertification = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Connaissance", inversedBy="idCandidat")
     * @ORM\JoinTable(name="candidat_connaissance",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Candidat", referencedColumnName="ID_Candidat")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Connaissance", referencedColumnName="ID_Connaissance")
     *   }
     * )
     */
    private $idConnaissance = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Formation", inversedBy="idCandidat")
     * @ORM\JoinTable(name="candidat_formation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Candidat", referencedColumnName="ID_Candidat")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Formation", referencedColumnName="ID_Formation")
     *   }
     * )
     */
    private $idFormation = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCertification = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idConnaissance = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idFormation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCandidat(): ?int
    {
        return $this->idCandidat;
    }


    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getAnneesExperience(): ?int
    {
        return $this->anneesExperience;
    }

    public function setAnneesExperience(int $anneesExperience): self
    {
        $this->anneesExperience = $anneesExperience;

        return $this;
    }

    public function getIdRecherche(): ?Recherche
    {
        return $this->idRecherche;
    }

    public function setIdRecherche(?Recherche $idRecherche): self
    {
        $this->idRecherche = $idRecherche;

        return $this;
    }

    /**
     * @return Collection<int, Certification>
     */
    public function getIdCertification(): Collection
    {
        return $this->idCertification;
    }

    public function addIdCertification(Certification $idCertification): self
    {
        if (!$this->idCertification->contains($idCertification)) {
            $this->idCertification->add($idCertification);
        }

        return $this;
    }

    public function removeIdCertification(Certification $idCertification): self
    {
        $this->idCertification->removeElement($idCertification);

        return $this;
    }

    /**
     * @return Collection<int, Connaissance>
     */
    public function getIdConnaissance(): Collection
    {
        return $this->idConnaissance;
    }

    public function addIdConnaissance(Connaissance $idConnaissance): self
    {
        if (!$this->idConnaissance->contains($idConnaissance)) {
            $this->idConnaissance->add($idConnaissance);
        }

        return $this;
    }

    public function removeIdConnaissance(Connaissance $idConnaissance): self
    {
        $this->idConnaissance->removeElement($idConnaissance);

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getIdFormation(): Collection
    {
        return $this->idFormation;
    }

    public function addIdFormation(Formation $idFormation): self
    {
        if (!$this->idFormation->contains($idFormation)) {
            $this->idFormation->add($idFormation);
        }

        return $this;
    }

    public function removeIdFormation(Formation $idFormation): self
    {
        $this->idFormation->removeElement($idFormation);

        return $this;
    }

}
