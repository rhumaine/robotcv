<?php

namespace App\Entity;

use App\Repository\CandidatConnaissanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatConnaissanceRepository::class)]
class CandidatConnaissance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_domaine = null;

    #[ORM\Column(length: 255)]
    private ?string $connaissance = null;

    #[ORM\Column]
    private ?int $id_candidat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDomaine(): ?int
    {
        return $this->id_domaine;
    }

    public function setIdDomaine(int $id_domaine): self
    {
        $this->id_domaine = $id_domaine;

        return $this;
    }

    public function getConnaissance(): ?string
    {
        return $this->connaissance;
    }

    public function setConnaissance(string $connaissance): self
    {
        $this->connaissance = $connaissance;

        return $this;
    }

    public function getIdCandidat(): ?int
    {
        return $this->id_candidat;
    }

    public function setIdCandidat(int $id_candidat): self
    {
        $this->id_candidat = $id_candidat;

        return $this;
    }
}
