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

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
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

    public function getDateMatching(): ?\DateTimeInterface
    {
        return $this->dateMatching;
    }

    public function setDateMatching(\DateTimeInterface $dateMatching): self
    {
        $this->dateMatching = $dateMatching;

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
