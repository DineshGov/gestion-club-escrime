<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjectifRepository")
 */
class Objectif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="objectifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objectif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atteint;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="objectifsAttribues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribuePar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireObjectif", mappedBy="objectif")
     */
    private $commentaireObjectifs;

    public function __construct()
    {
        $this->commentaireObjectifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTireur(): ?Tireur
    {
        return $this->tireur;
    }

    public function setTireur(?Tireur $tireur): self
    {
        $this->tireur = $tireur;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getAtteint(): ?bool
    {
        return $this->atteint;
    }

    public function setAtteint(bool $atteint): self
    {
        $this->atteint = $atteint;

        return $this;
    }

    public function getAttribuePar(): ?Membre
    {
        return $this->attribuePar;
    }

    public function setAttribuePar(?Membre $attribuePar): self
    {
        $this->attribuePar = $attribuePar;

        return $this;
    }

    /**
     * @return Collection|CommentaireObjectif[]
     */
    public function getCommentaireObjectifs(): Collection
    {
        return $this->commentaireObjectifs;
    }

    public function addCommentaireObjectif(CommentaireObjectif $commentaireObjectif): self
    {
        if (!$this->commentaireObjectifs->contains($commentaireObjectif)) {
            $this->commentaireObjectifs[] = $commentaireObjectif;
            $commentaireObjectif->setObjectif($this);
        }

        return $this;
    }

    public function removeCommentaireObjectif(CommentaireObjectif $commentaireObjectif): self
    {
        if ($this->commentaireObjectifs->contains($commentaireObjectif)) {
            $this->commentaireObjectifs->removeElement($commentaireObjectif);
            // set the owning side to null (unless already changed)
            if ($commentaireObjectif->getObjectif() === $this) {
                $commentaireObjectif->setObjectif(null);
            }
        }

        return $this;
    }
}
