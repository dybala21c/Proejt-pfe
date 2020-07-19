<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
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
    private $Type;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->HeureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $HeureDebut): self
    {
        $this->HeureDebut = $HeureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->HeureFin;
    }

    public function setHeureFin(\DateTimeInterface $HeureFin): self
    {
        $this->HeureFin = $HeureFin;

        return $this;
    }
}
