<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation", uniqueConstraints={@ORM\UniqueConstraint(name="Formation", columns={"Formation"})})
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Formation", type="integer", nullable=false, options={"comment"="Identifiant de la formation"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="Formation", type="string", length=200, nullable=false, options={"comment"="Le nom de la formation"})
     */
    private $formation;

    /**
     * @var string
     *
     * @ORM\Column(name="Institution", type="string", length=200, nullable=false, options={"comment"="Institution délivrant le diplome"})
     */
    private $institution;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Candidat", mappedBy="idFormation")
     */
    private $idCandidat = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCandidat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdFormation(): ?int
    {
        return $this->idFormation;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): self
    {
        $this->institution = $institution;

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
            $idCandidat->addIdFormation($this);
        }

        return $this;
    }

    public function removeIdCandidat(Candidat $idCandidat): self
    {
        if ($this->idCandidat->removeElement($idCandidat)) {
            $idCandidat->removeIdFormation($this);
        }

        return $this;
    }

}
