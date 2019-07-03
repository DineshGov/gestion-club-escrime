<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\Column(type="boolean")
     */
    private $idAdmin;

    /**
     * @Assert\Email
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="attribuePar", orphanRemoval=true)
     */
    private $objectifsAttribues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireObjectif", mappedBy="ecritPar", orphanRemoval=true)
     */
    private $commentaireObjectifs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireLecon", mappedBy="ecritPar", orphanRemoval=true)
     */
    private $commentaireLecons;



    public function __construct()
    {
        $this->objectifsAttribues = new ArrayCollection();
        $this->commentaireObjectifs = new ArrayCollection();
        $this->commentaireLecons = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(bool $idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifsAttribues(): Collection
    {
        return $this->objectifsAttribues;
    }

    public function addObjectifsAttribue(Objectif $objectifsAttribue): self
    {
        if (!$this->objectifsAttribues->contains($objectifsAttribue)) {
            $this->objectifsAttribues[] = $objectifsAttribue;
            $objectifsAttribue->setAttribuePar($this);
        }

        return $this;
    }

    public function removeObjectifsAttribue(Objectif $objectifsAttribue): self
    {
        if ($this->objectifsAttribues->contains($objectifsAttribue)) {
            $this->objectifsAttribues->removeElement($objectifsAttribue);
            // set the owning side to null (unless already changed)
            if ($objectifsAttribue->getAttribuePar() === $this) {
                $objectifsAttribue->setAttribuePar(null);
            }
        }

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
            $commentaireObjectif->setEcritPar($this);
        }

        return $this;
    }

    public function removeCommentaireObjectif(CommentaireObjectif $commentaireObjectif): self
    {
        if ($this->commentaireObjectifs->contains($commentaireObjectif)) {
            $this->commentaireObjectifs->removeElement($commentaireObjectif);
            // set the owning side to null (unless already changed)
            if ($commentaireObjectif->getEcritPar() === $this) {
                $commentaireObjectif->setEcritPar(null);
            }
        }

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
            $commentaireLecon->setEcritPar($this);
        }

        return $this;
    }

    public function removeCommentaireLecon(CommentaireLecon $commentaireLecon): self
    {
        if ($this->commentaireLecons->contains($commentaireLecon)) {
            $this->commentaireLecons->removeElement($commentaireLecon);
            // set the owning side to null (unless already changed)
            if ($commentaireLecon->getEcritPar() === $this) {
                $commentaireLecon->setEcritPar(null);
            }
        }

        return $this;
    }

}
