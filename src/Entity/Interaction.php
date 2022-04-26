<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interaction
 *
 * @ORM\Table(name="interaction")
 * @ORM\Entity
 */
class Interaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_interaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInteraction;

    /**
     * @var string
     *
     * @ORM\Column(name="type_interaction", type="string", length=20, nullable=false)
     */
    private $typeInteraction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_interaction", type="date", nullable=false)
     */
    private $dateInteraction;

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
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
