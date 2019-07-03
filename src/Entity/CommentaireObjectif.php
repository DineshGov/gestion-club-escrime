<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireObjectifRepository")
 */
class CommentaireObjectif
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
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objectif", inversedBy="commentaireObjectifs")
     */
    private $objectif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="commentaireObjectifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecritPar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getObjectif(): ?Objectif
    {
        return $this->objectif;
    }

    public function setObjectif(?Objectif $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getEcritPar(): ?Membre
    {
        return $this->ecritPar;
    }

    public function setEcritPar(?Membre $ecritPar): self
    {
        $this->ecritPar = $ecritPar;

        return $this;
    }
}
