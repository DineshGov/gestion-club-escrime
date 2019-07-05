<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use IntlDateFormatter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 * @ApiResource
 */
class Membre implements UserInterface
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
    private $isAdmin;

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
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     */
    private $rawPassword;

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

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

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

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin)
    {
        $this->isAdmin = $isAdmin;

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

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    /**
     * @param mixed $rawPassword
     */
    public function setRawPassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;
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

    /**
     * @Assert\Callback()
     */
    public function assertIsValid(ExecutionContextInterface $context){

        if(null === $this->getId() && null === $this->getRawPassword()){
            $context
                ->buildViolation('Vous devez définir un mot de passe')
                ->atPath('rawPassword')
                ->addViolation();
        }
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() {
        if (empty($this->roles)) {
            return ['ROLE_ADMIN'];
        }
        return $this->roles;
    }

    function addRole($role) {
        $this->roles[] = $role;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }

    // TODO: Implement __toString() method.
    public function __toString()
    {
        return $this->nom;
    }

    public function nomPrenom(){
        $dateActuelle=new \DateTime();
        $dateActuelle->format('Y');
        $age=$dateActuelle->diff($this->dateDeNaissance,true);
        $age=strval($age->y);
        return $this->nom.' '.$this->prenom .' Age : '.$age;
    }
}
