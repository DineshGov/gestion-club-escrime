<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaitreArmeRepository")
 */
class MaitreArme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Membre", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entrainement", mappedBy="entraineurs")
     */
    private $entrainements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="entraineur", orphanRemoval=true)
     */
    private $lecons;

    public function __construct()
    {
        $this->entrainements = new ArrayCollection();
        $this->lecons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(Membre $membre): self
    {
        $this->membre = $membre;

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
            $entrainement->addEntraineur($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainement $entrainement): self
    {
        if ($this->entrainements->contains($entrainement)) {
            $this->entrainements->removeElement($entrainement);
            $entrainement->removeEntraineur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Lecon[]
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    public function addLecon(Lecon $lecon): self
    {
        if (!$this->lecons->contains($lecon)) {
            $this->lecons[] = $lecon;
            $lecon->setEntraineur($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getEntraineur() === $this) {
                $lecon->setEntraineur(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        // TODO: Implement __toString() method.
        return $this->membre;
    }
}


