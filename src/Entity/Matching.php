<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matching
 *
 * @ORM\Table(name="matching")
 * @ORM\Entity
 */
class Matching
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_match", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMatch;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user1", type="integer", nullable=false)
     */
    private $idUser1;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user2", type="integer", nullable=false)
     */
    private $idUser2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_matching", type="date", nullable=false)
     */
    private $dateMatching;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
