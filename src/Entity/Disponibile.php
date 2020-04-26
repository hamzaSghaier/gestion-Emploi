<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DisponibileRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant", inversedBy="disponibiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enseignant;



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

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }



}
