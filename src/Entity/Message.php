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

    public function getIdMessage(): ?int
    {
        return $this->idMessage;
    }

    public function getMsgMessage(): ?string
    {
        return $this->msgMessage;
    }

    public function setMsgMessage(string $msgMessage): self
    {
        $this->msgMessage = $msgMessage;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getIdConversation(): ?int
    {
        return $this->idConversation;
    }

    public function setIdConversation(int $idConversation): self
    {
        $this->idConversation = $idConversation;

        return $this;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(int $archive): self
    {
        $this->archive = $archive;

        return $this;
    }


}
