<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut", uniqueConstraints={@ORM\UniqueConstraint(name="Statut", columns={"Statut"}), @ORM\UniqueConstraint(name="Statut_2", columns={"Statut"})})
 * @ORM\Entity(repositoryClass="App\Repository\StatutRepository")
 */
class Statut
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Statut", type="integer", nullable=false, options={"comment"="Identifiant du statut"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatut;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=50, nullable=false, options={"comment"="Statut"})
     */
    private $statut;

    public function getIdStatut(): ?int
    {
        return $this->idStatut;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


}
