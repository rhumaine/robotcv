<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="Email", columns={"Email"}), @ORM\UniqueConstraint(name="Email_2", columns={"Email"})}, indexes={@ORM\Index(name="ID_Statut", columns={"ID_Statut"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Utilisateur", type="integer", nullable=false, options={"comment"="Identifiant de l'utilisateur"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=100, nullable=false, options={"comment"="Prénom de l'utilisateur"})
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=100, nullable=false, options={"comment"="Nom de l'utilisateur"})
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=200, nullable=false, options={"comment"="Adresse email de l'utilisateur"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="MotDePasse", type="text", length=65535, nullable=false, options={"comment"="Mot de passe de l'utilisateur"})
     */
    private $motdepasse;

    /**
     * @var \Statut
     *
     * @ORM\ManyToOne(targetEntity="Statut")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Statut", referencedColumnName="ID_Statut")
     * })
     */
    private $idStatut;

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
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

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getIdStatut(): ?Statut
    {
        return $this->idStatut;
    }

    public function setIdStatut(?Statut $idStatut): self
    {
        $this->idStatut = $idStatut;

        return $this;
    }


}
