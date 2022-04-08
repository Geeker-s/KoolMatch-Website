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

    public function getIdConversation(): ?int
    {
        return $this->idConversation;
    }

    public function getTitreConversation(): ?string
    {
        return $this->titreConversation;
    }

    public function setTitreConversation(string $titreConversation): self
    {
        $this->titreConversation = $titreConversation;

        return $this;
    }

    public function getIdUser1(): ?int
    {
        return $this->idUser1;
    }

    public function setIdUser1(int $idUser1): self
    {
        $this->idUser1 = $idUser1;

        return $this;
    }

    public function getIdUser2(): ?int
    {
        return $this->idUser2;
    }

    public function setIdUser2(int $idUser2): self
    {
        $this->idUser2 = $idUser2;

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
