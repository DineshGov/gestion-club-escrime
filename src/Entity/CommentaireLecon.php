<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireLeconRepository")
 * @ApiResource
 */
class CommentaireLecon
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Lecon", inversedBy="commentaireLecons")
     */
    private $lecon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="commentaireLecons")
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

    public function getLecon(): ?Lecon
    {
        return $this->lecon;
    }

    public function setLecon(?Lecon $lecon): self
    {
        $this->lecon = $lecon;

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

    public function __toString()
    {
        return (string)$this->commentaire;
    }
}
