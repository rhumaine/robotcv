<?php

namespace App\Entity;

use App\Repository\CandidatPointsMarquantsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatPointsMarquantsRepository::class)]
class CandidatPointsMarquants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_candidat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pointsMarquants = null;

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

    public function getPointsMarquants(): ?string
    {
        return $this->pointsMarquants;
    }

    public function setPointsMarquants(?string $pointsMarquants): self
    {
        $this->pointsMarquants = $pointsMarquants;

        return $this;
    }
}
