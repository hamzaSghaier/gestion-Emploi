<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailsEmploiRepository")
 */
class DetailsEmploi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbHeureR;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Emploi", inversedBy="detailsEmplois")
     */
    private $emlpoi;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere")
     */
    private $Matiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disponibile")
     */
    private $seance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant")
     */
    private $enseignant;
    

   
 

   

    public function __construct()
    {
        $this->seance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbHeureR(): ?int
    {
        return $this->nbHeureR;
    }

    public function setNbHeureR(?int $nbHeureR): self
    {
        $this->nbHeureR = $nbHeureR;

        return $this;
    }

   



    public function getEmlpoi(): ?Emploi
    {
        return $this->emlpoi;
    }

    public function setEmlpoi(?Emploi $emlpoi): self
    {
        $this->emlpoi = $emlpoi;

        return $this;
    }

    public function __toString()
    {
        return "NbHeuer ". $this->nbHeureR;
    }




    public function getMatiere(): ?Matiere
    {
        return $this->Matiere;
    }

    public function setMatiere(?Matiere $Matiere): self
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getSeance(): ?Disponibile
    {
        return $this->seance;
    }

    public function setSeance(?Disponibile $seance): self
    {
        $this->seance = $seance;

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
