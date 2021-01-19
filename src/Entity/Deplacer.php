<?php

namespace App\Entity;

use App\Repository\DeplacerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeplacerRepository::class)
 */
class Deplacer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_km;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $essence;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="deplacements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=Transport::class, inversedBy="deplacements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $transport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrKm(): ?int
    {
        return $this->nbr_km;
    }

    public function setNbrKm(?int $nbr_km): self
    {
        $this->nbr_km = $nbr_km;

        return $this;
    }

    public function getEssence(): ?string
    {
        return $this->essence;
    }

    public function setEssence(?string $essence): self
    {
        $this->essence = $essence;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }
}
