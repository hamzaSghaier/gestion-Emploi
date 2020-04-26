<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveau;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbeleve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialite")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialite;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Promotion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promotion;

    public function __construct()
    {
        $this->affecters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getNbeleve(): ?int
    {
        return $this->nbeleve;
    }

    public function setNbeleve(int $nbeleve): self
    {
        $this->nbeleve = $nbeleve;

        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(?Specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }






    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }


    public function __toString()
    {
        return $this->specialite ." ". $this->nom  ." ". $this->promotion ;
    }

}
