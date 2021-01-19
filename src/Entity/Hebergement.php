<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HebergementRepository::class)
 */
class Hebergement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=PrevoirHebergement::class, mappedBy="hebergement")
     */
    private $prevoirHebergements;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->prevoirHebergements = new ArrayCollection();
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

    /**
     * @return Collection|PrevoirHebergement[]
     */
    public function getPrevoirHebergements(): Collection
    {
        return $this->prevoirHebergements;
    }

    public function addPrevoirHebergement(PrevoirHebergement $prevoirHebergement): self
    {
        if (!$this->prevoirHebergements->contains($prevoirHebergement)) {
            $this->prevoirHebergements[] = $prevoirHebergement;
            $prevoirHebergement->setHebergement($this);
        }

        return $this;
    }

    public function removePrevoirHebergement(PrevoirHebergement $prevoirHebergement): self
    {
        if ($this->prevoirHebergements->removeElement($prevoirHebergement)) {
            // set the owning side to null (unless already changed)
            if ($prevoirHebergement->getHebergement() === $this) {
                $prevoirHebergement->setHebergement(null);
            }
        }

        return $this;
    }
}
