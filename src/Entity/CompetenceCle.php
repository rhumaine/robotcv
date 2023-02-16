<?php

namespace App\Entity;

use App\Repository\CompetenceCleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceCleRepository::class)]
class CompetenceCle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_candidat = null;

    #[ORM\Column(length: 255)]
    private ?string $competence = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(string $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
