<?php

namespace App\Entity;

use App\Repository\TypeCongeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeCongeRepository::class)
 */
class TypeConge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Maladie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Maternite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Annuel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Recherche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Autres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaladie(): ?string
    {
        return $this->Maladie;
    }

    public function setMaladie(string $Maladie): self
    {
        $this->Maladie = $Maladie;

        return $this;
    }

    public function getMaternite(): ?string
    {
        return $this->Maternite;
    }

    public function setMaternite(string $Maternite): self
    {
        $this->Maternite = $Maternite;

        return $this;
    }

    public function getAnnuel(): ?string
    {
        return $this->Annuel;
    }

    public function setAnnuel(string $Annuel): self
    {
        $this->Annuel = $Annuel;

        return $this;
    }

    public function getRecherche(): ?string
    {
        return $this->Recherche;
    }

    public function setRecherche(string $Recherche): self
    {
        $this->Recherche = $Recherche;

        return $this;
    }

    public function getAutres(): ?string
    {
        return $this->Autres;
    }

    public function setAutres(string $Autres): self
    {
        $this->Autres = $Autres;

        return $this;
    }
}
