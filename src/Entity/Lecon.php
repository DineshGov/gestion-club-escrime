<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeconRepository")
 */
class Lecon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entrainement", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrainement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MaitreArme", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entraineur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireLecon", mappedBy="lecon")
     */
    private $commentaireLecons;

    public function __construct()
    {
        $this->commentaireLecons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrainement(): ?Entrainement
    {
        return $this->entrainement;
    }

    public function setEntrainement(?Entrainement $entrainement): self
    {
        $this->entrainement = $entrainement;

        return $this;
    }

    public function getEntraineur(): ?MaitreArme
    {
        return $this->entraineur;
    }

    public function setEntraineur(?MaitreArme $entraineur): self
    {
        $this->entraineur = $entraineur;

        return $this;
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

    /**
     * @return Collection|CommentaireLecon[]
     */
    public function getCommentaireLecons(): Collection
    {
        return $this->commentaireLecons;
    }

    public function addCommentaireLecon(CommentaireLecon $commentaireLecon): self
    {
        if (!$this->commentaireLecons->contains($commentaireLecon)) {
            $this->commentaireLecons[] = $commentaireLecon;
            $commentaireLecon->setLecon($this);
        }

        return $this;
    }

    public function removeCommentaireLecon(CommentaireLecon $commentaireLecon): self
    {
        if ($this->commentaireLecons->contains($commentaireLecon)) {
            $this->commentaireLecons->removeElement($commentaireLecon);
            // set the owning side to null (unless already changed)
            if ($commentaireLecon->getLecon() === $this) {
                $commentaireLecon->setLecon(null);
            }
        }

        return $this;
    }
}
