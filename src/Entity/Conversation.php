<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conversation
 *
 * @ORM\Table(name="conversation")
 * @ORM\Entity
 */
class Conversation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_conversation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConversation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_conversation", type="string", length=20, nullable=false)
     */
    private $titreConversation;

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
