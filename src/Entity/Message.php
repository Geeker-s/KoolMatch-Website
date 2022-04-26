<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="msg_message", type="string", length=100, nullable=false)
     */
    private $msgMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message", type="date", nullable=false)
     */
    private $dateMessage;

    /**
     * @var int
     *
     * @ORM\Column(name="id_conversation", type="integer", nullable=false)
     */
    private $idConversation;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


}
