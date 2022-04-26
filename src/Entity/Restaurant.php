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
     * @ORM\Column(name="archive", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $archive = NULL;

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


}
