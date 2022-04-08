<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity
 */
class Restaurant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_restaurant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRestaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_restaurant", type="string", length=20, nullable=false)
     */
    private $nomRestaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_restaurant", type="string", length=50, nullable=false)
     */
    private $adresseRestaurant;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_restaurant", type="integer", nullable=false)
     */
    private $telephoneRestaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="siteweb_restaurant", type="string", length=50, nullable=false)
     */
    private $sitewebRestaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite_restaurant", type="string", length=20, nullable=false)
     */
    private $specialiteRestaurant;

    /**
     * @var int
     *
     * @ORM\Column(name="id_gerant", type="integer", nullable=false)
     */
    private $idGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    private $image;

    /**
     * @var int|null
     *
     * @ORM\Column(name="archive", type="integer", nullable=true)
     */
    private $archive;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_placeResto", type="integer", nullable=false)
     */
    private $nbPlaceresto;

    /**
     * @var string
     *
     * @ORM\Column(name="image_structure_resturant", type="string", length=255, nullable=false)
     */
    private $imageStructureResturant;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=false)
     */
    private $lien;

    public function getIdRestaurant(): ?int
    {
        return $this->idRestaurant;
    }

    public function getNomRestaurant(): ?string
    {
        return $this->nomRestaurant;
    }

    public function setNomRestaurant(string $nomRestaurant): self
    {
        $this->nomRestaurant = $nomRestaurant;

        return $this;
    }

    public function getAdresseRestaurant(): ?string
    {
        return $this->adresseRestaurant;
    }

    public function setAdresseRestaurant(string $adresseRestaurant): self
    {
        $this->adresseRestaurant = $adresseRestaurant;

        return $this;
    }

    public function getTelephoneRestaurant(): ?int
    {
        return $this->telephoneRestaurant;
    }

    public function setTelephoneRestaurant(int $telephoneRestaurant): self
    {
        $this->telephoneRestaurant = $telephoneRestaurant;

        return $this;
    }

    public function getSitewebRestaurant(): ?string
    {
        return $this->sitewebRestaurant;
    }

    public function setSitewebRestaurant(string $sitewebRestaurant): self
    {
        $this->sitewebRestaurant = $sitewebRestaurant;

        return $this;
    }

    public function getSpecialiteRestaurant(): ?string
    {
        return $this->specialiteRestaurant;
    }

    public function setSpecialiteRestaurant(string $specialiteRestaurant): self
    {
        $this->specialiteRestaurant = $specialiteRestaurant;

        return $this;
    }

    public function getIdGerant(): ?int
    {
        return $this->idGerant;
    }

    public function setIdGerant(int $idGerant): self
    {
        $this->idGerant = $idGerant;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(?int $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getNbPlaceresto(): ?int
    {
        return $this->nbPlaceresto;
    }

    public function setNbPlaceresto(int $nbPlaceresto): self
    {
        $this->nbPlaceresto = $nbPlaceresto;

        return $this;
    }

    public function getImageStructureResturant(): ?string
    {
        return $this->imageStructureResturant;
    }

    public function setImageStructureResturant(string $imageStructureResturant): self
    {
        $this->imageStructureResturant = $imageStructureResturant;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }


}
