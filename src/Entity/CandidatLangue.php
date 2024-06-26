<?php

namespace App\Entity;

use App\Repository\CandidatLangueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatLangueRepository::class)]
class CandidatLangue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_langue = null;

    #[ORM\Column]
    private ?int $niveau = null;

    #[ORM\Column]
    private ?int $id_candidat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLangue(): ?int
    {
        return $this->id_langue;
    }

    public function setIdLangue(int $id_langue): self
    {
        $this->id_langue = $id_langue;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

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
