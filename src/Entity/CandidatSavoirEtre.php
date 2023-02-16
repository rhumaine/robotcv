<?php

namespace App\Entity;

use App\Repository\CandidatSavoirEtreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatSavoirEtreRepository::class)]
class CandidatSavoirEtre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $savoiretre = null;

    #[ORM\Column]
    private ?int $id_candidat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSavoiretre(): ?string
    {
        return $this->savoiretre;
    }

    public function setSavoiretre(string $savoiretre): self
    {
        $this->savoiretre = $savoiretre;

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
