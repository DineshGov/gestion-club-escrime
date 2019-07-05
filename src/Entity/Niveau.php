<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 * @ApiResource
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tireur", mappedBy="niveau")
     */
    private $tireur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="niveau")
     */
    private $competitions;

    public function __construct()
    {
        $this->tireur = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Tireur[]
     */
    public function getTireur(): Collection
    {
        return $this->tireur;
    }

    public function addTireur(Tireur $tireur): self
    {
        if (!$this->tireur->contains($tireur)) {
            $this->tireur[] = $tireur;
            $tireur->setNiveau($this);
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireur->contains($tireur)) {
            $this->tireur->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getNiveau() === $this) {
                $tireur->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions[] = $competition;
            $competition->addNiveau($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeNiveau($this);
        }

        return $this;
    }
}
