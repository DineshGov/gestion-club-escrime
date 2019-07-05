<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 * @ApiResource
 */
class Groupe
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrainement", mappedBy="groupe", orphanRemoval=true)
     */
    private $entrainements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tireur", mappedBy="groupe")
     */
    private $tireurs;


    public function __construct()
    {
        $this->entrainements = new ArrayCollection();
        $this->tireurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Entrainement[]
     */
    public function getEntrainements(): Collection
    {
        return $this->entrainements;
    }

    public function addEntrainement(Entrainement $entrainement): self
    {
        if (!$this->entrainements->contains($entrainement)) {
            $this->entrainements[] = $entrainement;
            $entrainement->setGroupe($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainement $entrainement): self
    {
        if ($this->entrainements->contains($entrainement)) {
            $this->entrainements->removeElement($entrainement);
            // set the owning side to null (unless already changed)
            if ($entrainement->getGroupe() === $this) {
                $entrainement->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tireur[]
     */
    public function getTireurs(): Collection
    {
        return $this->tireurs;
    }

    public function addTireur(Tireur $tireur): self
    {
        if (!$this->tireurs->contains($tireur)) {
            $this->tireurs[] = $tireur;
            $tireur->setGroupe($this);
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getGroupe() === $this) {
                $tireur->setGroupe(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom;
    }

}
