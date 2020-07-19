<?php

namespace App\Entity;

use App\Repository\AttestationTravailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttestationTravailRepository::class)
 */
class AttestationTravail
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
    private $Motif;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDelivrance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->Motif;
    }

    public function setMotif(string $Motif): self
    {
        $this->Motif = $Motif;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->DateDelivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $DateDelivrance): self
    {
        $this->DateDelivrance = $DateDelivrance;

        return $this;
    }
}
