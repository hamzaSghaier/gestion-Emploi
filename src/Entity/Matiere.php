<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
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
    private $Nom_matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $NhTHC;

    /**
     * @ORM\Column(type="integer")
     */
    private $NhTD;

    /**
     * @ORM\Column(type="integer")
     */
    private $NhTP;

    /**
     * @ORM\Column(type="float")
     */
    private $coefMatiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $Niveau;

    /**
     * @ORM\Column(type="integer")
     */
    private $semestre;

    /**
     * @ORM\Column(type="integer")
     */
    private $NhTotal;


    public function __construct()
    {
        $this->affecters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->Nom_matiere;
    }

    public function setNomMatiere(string $Nom_matiere): self
    {
        $this->Nom_matiere = $Nom_matiere;

        return $this;
    }

    public function getNhTHC(): ?int
    {
        return $this->NhTHC;
    }

    public function setNhTHC(int $NhTHC): self
    {
        $this->NhTHC = $NhTHC;

        return $this;
    }

    public function getNhTD(): ?int
    {
        return $this->NhTD;
    }

    public function setNhTD(int $NhTD): self
    {
        $this->NhTD = $NhTD;

        return $this;
    }

    public function getNhTP(): ?int
    {
        return $this->NhTP;
    }

    public function setNhTP(int $NhTP): self
    {
        $this->NhTP = $NhTP;

        return $this;
    }

    public function getCoefMatiere(): ?float
    {
        return $this->coefMatiere;
    }

    public function setCoefMatiere(float $coefMatiere): self
    {
        $this->coefMatiere = $coefMatiere;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->Niveau;
    }

    public function setNiveau(int $Niveau): self
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(int $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getNhTotal(): ?int
    {
        return $this->NhTotal;
    }

    public function setNhTotal(int $NhTotal): self
    {
        $this->NhTotal = $NhTotal;

        return $this;
    }

    public function __toString()
    {
        return $this->Nom_matiere;
    }




}
