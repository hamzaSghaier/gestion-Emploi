<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnseignantRepository")
 */
class Enseignant
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
    private $nom_enseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_enseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Grade;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_travail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Cin;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Disponibile", mappedBy="enseignant", orphanRemoval=true)
     */
    private $disponibiles;

    public function __construct()
    {
        $this->disponibiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnseignant(): ?string
    {
        return $this->nom_enseignant;
    }

    public function setNomEnseignant(string $nom_enseignant): self
    {
        $this->nom_enseignant = $nom_enseignant;

        return $this;
    }

    public function getPrenomEnseignant(): ?string
    {
        return $this->prenom_enseignant;
    }

    public function setPrenomEnseignant(string $prenom_enseignant): self
    {
        $this->prenom_enseignant = $prenom_enseignant;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->Grade;
    }

    public function setGrade(string $Grade): self
    {
        $this->Grade = $Grade;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getLieuTravail(): ?string
    {
        return $this->lieu_travail;
    }

    public function setLieuTravail(string $lieu_travail): self
    {
        $this->lieu_travail = $lieu_travail;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->Cin;
    }

    public function setCin(string $Cin): self
    {
        $this->Cin = $Cin;

        return $this;
    }





    public function __toString()
    {
        return $this->nom_enseignant ." ". $this->prenom_enseignant  ;
    }



    /**
     * @return Collection|Disponibile[]
     */
    public function getDisponibiles(): Collection
    {
        return $this->disponibiles;
    }

    public function addDisponibile(Disponibile $disponibile): self
    {
        if (!$this->disponibiles->contains($disponibile)) {
            $this->disponibiles[] = $disponibile;
            $disponibile->setEnseignant($this);
        }

        return $this;
    }

    public function removeDisponibile(Disponibile $disponibile): self
    {
        if ($this->disponibiles->contains($disponibile)) {
            $this->disponibiles->removeElement($disponibile);
            // set the owning side to null (unless already changed)
            if ($disponibile->getEnseignant() === $this) {
                $disponibile->setEnseignant(null);
            }
        }

        return $this;
    }
}
