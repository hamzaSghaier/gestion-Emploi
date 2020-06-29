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
     * @ORM\Column(type="float", nullable=true)
     */
    private $nbHeureR;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Emploi", inversedBy="detailsEmplois")
     */
    private $emlpoi;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere",cascade={"remove"})
    * @ORM\JoinColumn(onDelete="CASCADE")
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

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $autre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alert;





    
   
 

   

    public function __construct()
    {
        $this->seance = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbHeureR(): ?float
    {
        return $this->nbHeureR;
    }

    public function setNbHeureR(?float $nbHeureR): self
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

    public function getAutre(): ?string
    {
        return $this->autre;
    }

    public function setAutre(string $autre): self
    {
        $this->autre = $autre;

        return $this;
    }

    public function getAlert(): ?string
    {
        return $this->alert;
    }

    public function setAlert(?string $alert): self
    {
        $this->alert = $alert;

        return $this;
    }



  


   

  

}
