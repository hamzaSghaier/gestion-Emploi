<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmploiRepository")
 */
class Emploi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsEmploi", mappedBy="emlpoi")
     */
    private $detailsEmplois;

    public function __construct()
    {
        $this->detailsEmplois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTimeInterface $DateFin): self
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getClasse(): ?Groupe
    {
        return $this->classe;
    }

    public function setClasse(?Groupe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|DetailsEmploi[]
     */
    public function getDetailsEmplois(): Collection
    {
        return $this->detailsEmplois;
    }

    public function addDetailsEmplois(DetailsEmploi $detailsEmplois): self
    {
        if (!$this->detailsEmplois->contains($detailsEmplois)) {
            $this->detailsEmplois[] = $detailsEmplois;
            $detailsEmplois->setEmlpoi($this);
        }

        return $this;
    }

    public function removeDetailsEmplois(DetailsEmploi $detailsEmplois): self
    {
        if ($this->detailsEmplois->contains($detailsEmplois)) {
            $this->detailsEmplois->removeElement($detailsEmplois);
            // set the owning side to null (unless already changed)
            if ($detailsEmplois->getEmlpoi() === $this) {
                $detailsEmplois->setEmlpoi(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return "Emploi de ". $this->dateDebut->format('Y-m-d');
    }
}
