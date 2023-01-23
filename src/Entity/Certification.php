<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Certification
 *
 * @ORM\Table(name="certification", uniqueConstraints={@ORM\UniqueConstraint(name="Certification", columns={"Certification"})})
 * @ORM\Entity(repositoryClass="App\Repository\CertificationRepository")
 */
class Certification
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Certification", type="integer", nullable=false, options={"comment"="Identifiant de la certification"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCertification;

    /**
     * @var string
     *
     * @ORM\Column(name="Certification", type="string", length=200, nullable=false, options={"comment"="Nom de la certification"})
     */
    private $certification;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Logo_certification", type="text", length=65535, nullable=true, options={"default"="NULL","comment"="Lien vers le logo de la certification"})
     */
    private $logoCertification = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Candidat", mappedBy="idCertification")
     */
    private $idCandidat = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCandidat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCertification(): ?int
    {
        return $this->idCertification;
    }

    public function getCertification(): ?string
    {
        return $this->certification;
    }

    public function setCertification(string $certification): self
    {
        $this->certification = $certification;

        return $this;
    }

    public function getLogoCertification(): ?string
    {
        return $this->logoCertification;
    }

    public function setLogoCertification(?string $logoCertification): self
    {
        $this->logoCertification = $logoCertification;

        return $this;
    }

    /**
     * @return Collection<int, Candidat>
     */
    public function getIdCandidat(): Collection
    {
        return $this->idCandidat;
    }

    public function addIdCandidat(Candidat $idCandidat): self
    {
        if (!$this->idCandidat->contains($idCandidat)) {
            $this->idCandidat->add($idCandidat);
            $idCandidat->addIdCertification($this);
        }

        return $this;
    }

    public function removeIdCandidat(Candidat $idCandidat): self
    {
        if ($this->idCandidat->removeElement($idCandidat)) {
            $idCandidat->removeIdCertification($this);
        }

        return $this;
    }

}
