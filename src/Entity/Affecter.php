<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AffecterRepository")
 * @UniqueEntity(
 *     fields={"matiere", "groupe"},
 *     errorPath="matiere",
 *     message="This matiere is already in use on that groupe."
 * )
 */
 
class Affecter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere",cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enseignant;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $conteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

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

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getConteur(): ?float
    {
        return $this->conteur;
    }

    public function setConteur(?float $conteur): self
    {
        $this->conteur = $conteur;

        return $this;
    }
}
