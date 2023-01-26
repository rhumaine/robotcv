<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="Email", columns={"email"}), @ORM\UniqueConstraint(name="Email_2", columns={"email"})}, indexes={@ORM\Index(name="ID_Statut", columns={"ID_Statut"})})
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
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
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false, options={"comment"="Prénom de l'utilisateur"})
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false, options={"comment"="Nom de l'utilisateur"})
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=false, options={"comment"="Adresse email de l'utilisateur"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=65535, nullable=false, options={"comment"="Mot de passe de l'utilisateur"})
     */
    private $password;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function __toString() {
        return $this->email;
    }

}
