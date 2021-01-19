<?php

namespace App\Entity;

use App\Repository\PrevoirHebergementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrevoirHebergementRepository::class)
 * @ORM\Table(name="PrevoirHebergement")
 * 
 */
class PrevoirHebergement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $justification;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="prevoirHebergements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=Hebergement::class, inversedBy="prevoirHebergements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hebergement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJustification(): ?string
    {
        return $this->justification;
    }

    public function setJustification(?string $justification): self
    {
        $this->justification = $justification;

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

    public function getHebergement(): ?Hebergement
    {
        return $this->hebergement;
    }

    public function setHebergement(?Hebergement $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }
}
