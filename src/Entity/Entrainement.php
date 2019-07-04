<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrainementRepository")
 */
class Entrainement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="entrainements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tireur", inversedBy="entrainements")
     */
    private $tireurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MaitreArme", inversedBy="entrainements")
     */
        private $entraineurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="entrainement", orphanRemoval=true)
     */
    private $lecons;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Presence", mappedBy="entrainement", cascade={"persist", "remove"})
     */
    private $presence;

    public function __construct()
    {
        $this->tireurs = new ArrayCollection();
        $this->entraineurs = new ArrayCollection();
        $this->lecons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

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
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
        }

        return $this;
    }

    /**
     * @return Collection|MaitreArme[]
     */
    public function getEntraineurs():Collection
    {
        return $this->entraineurs;
    }
    

    public function addEntraineur(MaitreArme $entraineur): self
    {
        if (!$this->entraineurs->contains($entraineur)) {
            $this->entraineurs[] = $entraineur;
        }

        return $this;
    }

    public function removeEntraineur(MaitreArme $entraineur): self
    {
        if ($this->entraineurs->contains($entraineur)) {
            $this->entraineurs->removeElement($entraineur);
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
            $lecon->setEntrainement($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getEntrainement() === $this) {
                $lecon->setEntrainement(null);
            }
        }

        return $this;
    }

    public function getPresence(): ?Presence
    {
        return $this->presence;
    }

    public function setPresence(Presence $presence): self
    {
        $this->presence = $presence;

        // set the owning side of the relation if necessary
        if ($this !== $presence->getEntrainement()) {
            $presence->setEntrainement($this);
        }

        return $this;
    }



}
