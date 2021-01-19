<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=PrevoirHebergement::class, mappedBy="mission")
     */
    private $prevoirHebergements;

    /**
     * @ORM\OneToMany(targetEntity=Deplacer::class, mappedBy="mission")
     */
    private $deplacements;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->justification = new ArrayCollection();
        $this->prevoirHebergements = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

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
            $prevoirHebergement->setMission($this);
        }

        return $this;
    }

    public function removePrevoirHebergement(PrevoirHebergement $prevoirHebergement): self
    {
        if ($this->prevoirHebergements->removeElement($prevoirHebergement)) {
            // set the owning side to null (unless already changed)
            if ($prevoirHebergement->getMission() === $this) {
                $prevoirHebergement->setMission(null);
            }
        }

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
            $deplacement->setMission($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacer $deplacement): self
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getMission() === $this) {
                $deplacement->setMission(null);
            }
        }

        return $this;
    }

    public function getDestination(): ?Ville
    {
        return $this->destination;
    }

    public function setDestination(?Ville $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
