<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CandidatLangue
 *
 * @ORM\Table(name="candidat_langue", indexes={@ORM\Index(name="ID_Niveau", columns={"ID_Niveau"}), @ORM\Index(name="ID_Langue", columns={"ID_Langue"}), @ORM\Index(name="IDX_2D9C88F2AD9B6B5", columns={"ID_Candidat"})})
 * @ORM\Entity(repositoryClass="App\Repository\CandidatLangueRepository")
 */
class CandidatLangue
{
    /**
     * @var \Candidat
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Candidat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Candidat", referencedColumnName="ID_Candidat")
     * })
     */
    private $idCandidat;

    /**
     * @var \Langue
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Langue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Langue", referencedColumnName="ID_Langue")
     * })
     */
    private $idLangue;

    /**
     * @var \Niveau
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Niveau", referencedColumnName="ID_Niveau")
     * })
     */
    private $idNiveau;

    public function getIdCandidat(): ?Candidat
    {
        return $this->idCandidat;
    }

    public function setIdCandidat(?Candidat $idCandidat): self
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }

    public function getIdLangue(): ?Langue
    {
        return $this->idLangue;
    }

    public function setIdLangue(?Langue $idLangue): self
    {
        $this->idLangue = $idLangue;

        return $this;
    }

    public function getIdNiveau(): ?Niveau
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(?Niveau $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
    }


}
