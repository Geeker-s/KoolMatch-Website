<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gerant
 *
 * @ORM\Table(name="gerant")
 * @ORM\Entity
 */
class Gerant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_gerant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_gerant", type="string", length=100, nullable=false)
     */
    private $nomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_gerant", type="string", length=100, nullable=false)
     */
    private $prenomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="email_gerant", type="string", length=255, nullable=false)
     */
    private $emailGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="password_gerant", type="string", length=255, nullable=false)
     */
    private $passwordGerant;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_gerant", type="integer", nullable=false)
     */
    private $telephoneGerant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dd_abonnement", type="date", nullable=false)
     */
    private $ddAbonnement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="df_abonnement", type="date", nullable=false)
     */
    private $dfAbonnement;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
