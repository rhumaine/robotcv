<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domaine
 *
 * @ORM\Table(name="domaine", uniqueConstraints={@ORM\UniqueConstraint(name="Domaine", columns={"Domaine"})})
 * @ORM\Entity
 */
class Domaine
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Domaine", type="integer", nullable=false, options={"comment"="Identifiant du domaine"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDomaine;

    /**
     * @var string
     *
     * @ORM\Column(name="Domaine", type="string", length=100, nullable=false, options={"comment"="Domaine technique"})
     */
    private $domaine;

    public function getIdDomaine(): ?int
    {
        return $this->idDomaine;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }


}
