<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransportRepository::class)
 */
class Transport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $chevaux;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $coeff_km;

    /**
     * @ORM\OneToMany(targetEntity=Deplacer::class, mappedBy="transport")
     */
    private $deplacements;

    public function __construct()
    {
        $this->deplacements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getChevaux(): ?int
    {
        return $this->chevaux;
    }

    public function setChevaux(?int $chevaux): self
    {
        $this->chevaux = $chevaux;

        return $this;
    }

    public function getCoeffKm(): ?float
    {
        return $this->coeff_km;
    }

    public function setCoeffKm(?float $coeff_km): self
    {
        $this->coeff_km = $coeff_km;

        return $this;
    }

    /**
     * @return Collection|Deplacer[]
     */
    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacer $deplacement): self
    {
        if (!$this->deplacements->contains($deplacement)) {
            $this->deplacements[] = $deplacement;
            $deplacement->setTransport($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacer $deplacement): self
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getTransport() === $this) {
                $deplacement->setTransport(null);
            }
        }

        return $this;
    }
}
