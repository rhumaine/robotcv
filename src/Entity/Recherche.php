<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recherche
 *
 * @ORM\Table(name="recherche", uniqueConstraints={@ORM\UniqueConstraint(name="Recherche", columns={"Recherche"})})
 * @ORM\Entity(repositoryClass="App\Repository\RechercheRepository")
 */
class Recherche
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Recherche", type="integer", nullable=false, options={"comment"="Identifiant de l'étape de recherche"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecherche;

    /**
     * @var string
     *
     * @ORM\Column(name="Recherche", type="string", length=200, nullable=false, options={"comment"="Etape de la recherche"})
     */
    private $recherche;

    public function getIdRecherche(): ?int
    {
        return $this->idRecherche;
    }

    public function getRecherche(): ?string
    {
        return $this->recherche;
    }

    public function setRecherche(string $recherche): self
    {
        $this->recherche = $recherche;

        return $this;
    }


}
