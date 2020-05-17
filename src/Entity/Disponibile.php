<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DisponibileRepository")
 * @UniqueEntity(
 *     fields={"seance", "jour"},
 *     errorPath="jour",
 *     message="This seance is already in use on that jour."
 * )
 */
class Disponibile
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
    private $seance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jour;




    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Enseignant", mappedBy="disponibles" ,cascade={"persist"})
     */
    private $enseignants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailsEmploi", inversedBy="seance")
     */
    private $detailsEmploi;

    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeance(): ?string
    {
        return $this->seance;
    }

    public function setSeance(string $seance): self
    {
        $this->seance = $seance;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }


    public function __toString()
    {
        return $this->jour ." ". $this->seance  ;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants[] = $enseignant;
            $enseignant->addDisponible($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->contains($enseignant)) {
            $this->enseignants->removeElement($enseignant);
            $enseignant->removeDisponible($this);
        }

        return $this;
    }

    public function getDetailsEmploi(): ?DetailsEmploi
    {
        return $this->detailsEmploi;
    }

    public function setDetailsEmploi(?DetailsEmploi $detailsEmploi): self
    {
        $this->detailsEmploi = $detailsEmploi;

        return $this;
    }

}
