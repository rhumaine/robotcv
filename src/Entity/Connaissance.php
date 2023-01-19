<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Connaissance
 *
 * @ORM\Table(name="connaissance", uniqueConstraints={@ORM\UniqueConstraint(name="Connaissance", columns={"Connaissance"})}, indexes={@ORM\Index(name="ID_Domaine", columns={"ID_Domaine"})})
 * @ORM\Entity
 */
class Connaissance
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Connaissance", type="integer", nullable=false, options={"comment"="Identifiant de la connaissance technique"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConnaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Connaissance", type="string", length=200, nullable=false, options={"comment"="Connaissance technique"})
     */
    private $connaissance;

    /**
     * @var \Domaine
     *
     * @ORM\ManyToOne(targetEntity="Domaine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Domaine", referencedColumnName="ID_Domaine")
     * })
     */
    private $idDomaine;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Candidat", mappedBy="idConnaissance")
     */
    private $idCandidat = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCandidat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdConnaissance(): ?int
    {
        return $this->idConnaissance;
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

    public function getIdDomaine(): ?Domaine
    {
        return $this->idDomaine;
    }

    public function setIdDomaine(?Domaine $idDomaine): self
    {
        $this->idDomaine = $idDomaine;

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
            $idCandidat->addIdConnaissance($this);
        }

        return $this;
    }

    public function removeIdCandidat(Candidat $idCandidat): self
    {
        if ($this->idCandidat->removeElement($idCandidat)) {
            $idCandidat->removeIdConnaissance($this);
        }

        return $this;
    }

}
