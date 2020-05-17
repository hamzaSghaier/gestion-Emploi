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
     * @ORM\OneToMany(targetEntity="App\Entity\Disponibile", mappedBy="detailsEmploi")
     */
    private $seance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Emploi", inversedBy="detailsEmplois")
     */
    private $emlpoi;

   

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

    /**
     * @return Collection|Disponibile[]
     */
    public function getSeance(): Collection
    {
        return $this->seance;
    }

    public function addSeance(Disponibile $seance): self
    {
        if (!$this->seance->contains($seance)) {
            $this->seance[] = $seance;
            $seance->setDetailsEmploi($this);
        }

        return $this;
    }

    public function removeSeance(Disponibile $seance): self
    {
        if ($this->seance->contains($seance)) {
            $this->seance->removeElement($seance);
            // set the owning side to null (unless already changed)
            if ($seance->getDetailsEmploi() === $this) {
                $seance->setDetailsEmploi(null);
            }
        }

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



}
