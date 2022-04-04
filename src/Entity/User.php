<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=100, nullable=false)
     */
    private $emailUser;

    /**
     * @var string
     *
     * @ORM\Column(name="password_user", type="string", length=20, nullable=false)
     */
    private $passwordUser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=20, nullable=false)
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_user", type="string", length=20, nullable=false)
     */
    private $prenomUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance_user", type="date", nullable=false)
     */
    private $datenaissanceUser;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe_user", type="string", length=20, nullable=false)
     */
    private $sexeUser;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_user", type="integer", nullable=false)
     */
    private $telephoneUser;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_user", type="string", length=100, nullable=false)
     */
    private $photoUser;

    /**
     * @var string
     *
     * @ORM\Column(name="description_user", type="string", length=100, nullable=false)
     */
    private $descriptionUser;

    /**
     * @var int
     *
     * @ORM\Column(name="maxDistance_user", type="integer", nullable=false)
     */
    private $maxdistanceUser;

    /**
     * @var int
     *
     * @ORM\Column(name="preferredMinAge_user", type="integer", nullable=false)
     */
    private $preferredminageUser;

    /**
     * @var int
     *
     * @ORM\Column(name="preferredMaxAge_user", type="integer", nullable=false)
     */
    private $preferredmaxageUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_user", type="string", length=255, nullable=false, options={"default"="x"})
     */
    private $adresseUser = 'x';

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="Interet_user", type="integer", nullable=false)
     */
    private $interetUser;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
