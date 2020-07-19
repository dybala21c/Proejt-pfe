<?php

namespace App\Entity;

use App\Repository\TypeSeanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeSeanceRepository::class)
 */
class TypeSeance
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
    private $Cours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TD;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TP;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCours(): ?string
    {
        return $this->Cours;
    }

    public function setCours(string $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }

    public function getTD(): ?string
    {
        return $this->TD;
    }

    public function setTD(string $TD): self
    {
        $this->TD = $TD;

        return $this;
    }

    public function getTP(): ?string
    {
        return $this->TP;
    }

    public function setTP(string $TP): self
    {
        $this->TP = $TP;

        return $this;
    }
}
