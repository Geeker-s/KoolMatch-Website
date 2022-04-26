<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=20, nullable=false)
     */
    private $nomEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dd_event", type="date", nullable=false)
     */
    private $ddEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="df_event", type="date", nullable=false)
     */
    private $dfEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_event", type="string", length=50, nullable=false)
     */
    private $themeEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_event", type="string", length=20, nullable=false)
     */
    private $adresseEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
