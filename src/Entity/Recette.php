<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recette", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recette", type="string", length=20, nullable=false)
     */
    private $nomRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_recette", type="string", length=255, nullable=false)
     */
    private $photoRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="description_recette", type="string", length=255, nullable=false)
     */
    private $descriptionRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_recette", type="string", length=20, nullable=false)
     */
    private $categorieRecette;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_recette", type="integer", nullable=false)
     */
    private $dureeRecette;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
