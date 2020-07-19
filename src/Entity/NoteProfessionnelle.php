<?php

namespace App\Entity;

use App\Repository\NoteProfessionnelleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteProfessionnelleRepository::class)
 */
class NoteProfessionnelle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Appreciation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->Annee;
    }

    public function setAnnee(\DateTimeInterface $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->Appreciation;
    }

    public function setAppreciation(string $Appreciation): self
    {
        $this->Appreciation = $Appreciation;

        return $this;
    }
}
