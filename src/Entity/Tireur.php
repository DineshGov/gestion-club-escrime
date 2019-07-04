<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TireurRepository")
 */
class Tireur
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
    private $blason;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauSurclassement;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Membre", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="tireur",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="tireurs")
     */
    private $competitions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entrainement", mappedBy="tireurs")
     */
    private $entrainements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="tireur", orphanRemoval=true)
     */
    private $lecons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="tireur", orphanRemoval=true)
     */
    private $objectifs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Arme", inversedBy="tireurs")
     */
    private $armes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Presence", inversedBy="tireurs")
     */
    private $presence;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Presence", mappedBy="tireursPresents")
     */
    private $presences;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->entrainements = new ArrayCollection();
        $this->lecons = new ArrayCollection();
        $this->objectifs = new ArrayCollection();
        $this->armes = new ArrayCollection();
        $this->presences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlason(): ?string
    {
        return $this->blason;
    }

    public function setBlason(string $blason): self
    {
        $this->blason = $blason;

        return $this;
    }

    public function getNiveauSurclassement(): ?int
    {
        return $this->niveauSurclassement;
    }

    public function setNiveauSurclassement(int $niveauSurclassement): self
    {
        $this->niveauSurclassement = $niveauSurclassement;

        return $this;
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

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

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
            $competition->addTireur($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeTireur($this);
        }

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
            $entrainement->addTireur($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainement $entrainement): self
    {
        if ($this->entrainements->contains($entrainement)) {
            $this->entrainements->removeElement($entrainement);
            $entrainement->removeTireur($this);
        }

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
            $lecon->setTireur($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getTireur() === $this) {
                $lecon->setTireur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): self
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs[] = $objectif;
            $objectif->setTireur($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->contains($objectif)) {
            $this->objectifs->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getTireur() === $this) {
                $objectif->setTireur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Arme[]
     */
    public function getArmes(): Collection
    {
        return $this->armes;
    }

    public function addArme(Arme $arme): self
    {
        if (!$this->armes->contains($arme)) {
            $this->armes[] = $arme;
        }

        return $this;
    }

    public function removeArme(Arme $arme): self
    {
        if ($this->armes->contains($arme)) {
            $this->armes->removeElement($arme);
        }

        return $this;
    }

    public function getPresence(): ?Presence
    {
        return $this->presence;
    }

    public function setPresence(?Presence $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * @return Collection|Presence[]
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences[] = $presence;
            $presence->addTireursPresent($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->contains($presence)) {
            $this->presences->removeElement($presence);
            $presence->removeTireursPresent($this);
        }

        return $this;
    }
}
