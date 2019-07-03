<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresenceRepository")
 */
class Presence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Entrainement", inversedBy="presence", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrainement;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tireur", inversedBy="presences")
     */
    private $tireursPresents;

    public function __construct()
    {
        $this->tireursPresents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrainement(): ?Entrainement
    {
        return $this->entrainement;
    }

    public function setEntrainement(Entrainement $entrainement): self
    {
        $this->entrainement = $entrainement;

        return $this;
    }

    /**
     * @return Collection|Tireur[]
     */
    public function getTireursPresents(): Collection
    {
        return $this->tireursPresents;
    }

    public function addTireursPresent(Tireur $tireursPresent): self
    {
        if (!$this->tireursPresents->contains($tireursPresent)) {
            $this->tireursPresents[] = $tireursPresent;
        }

        return $this;
    }

    public function removeTireursPresent(Tireur $tireursPresent): self
    {
        if ($this->tireursPresents->contains($tireursPresent)) {
            $this->tireursPresents->removeElement($tireursPresent);
        }

        return $this;
    }
}
