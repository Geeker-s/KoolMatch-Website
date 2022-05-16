<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity
 */
class Invitation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_invitation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("Invitation")
     */
    private $idInvitation;

    /**
     * @var string
     * @Assert\NotBlank(message="Nom evenement doit etre non vide")
     * @ORM\Column(name="nom_event", type="string", length=255, nullable=false)
     * @Groups("Invitation")
     *
     */
    private $nomEvent;

    /**
     * @var int
     *@Assert\NotBlank(message="Id User doit etre non vide")
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @Groups("Invitation")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     * @Groups("Invitation")
     */
    private $archive = '0';

    public function getIdInvitation(): ?int
    {
        return $this->idInvitation;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

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
