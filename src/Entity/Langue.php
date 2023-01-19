<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue", uniqueConstraints={@ORM\UniqueConstraint(name="Langue", columns={"Langue"})})
 * @ORM\Entity
 */
class Langue
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Langue", type="integer", nullable=false, options={"comment"="Identifiant de la langue"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="Langue", type="string", length=50, nullable=false, options={"comment"="Langue"})
     */
    private $langue;

    public function getIdLangue(): ?int
    {
        return $this->idLangue;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }


}
