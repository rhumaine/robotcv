<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau", uniqueConstraints={@ORM\UniqueConstraint(name="Niveau", columns={"Niveau"})})
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Niveau", type="integer", nullable=false, options={"comment"="Identifiant du niveau"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNiveau;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau", type="string", length=50, nullable=false, options={"comment"="Niveau de pratique"})
     */
    private $niveau;

    public function getIdNiveau(): ?int
    {
        return $this->idNiveau;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }


}
