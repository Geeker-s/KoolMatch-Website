<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Matching
 *
 * @ORM\Table(name="matching", indexes={@ORM\Index(name="fk_user2_matching", columns={"id_user2"}), @ORM\Index(name="fk_user1_matching", columns={"id_user1"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_matching", type="date", nullable=false)
     * @Assert\LessThanOrEqual("today",message="la date doit être inférieure a {{ compared_value }}.")
     */
    private $dateMatching;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user1", referencedColumnName="id_user")
     * })
     */
    private $idUser1;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user2", referencedColumnName="id_user")
     * })
     */
    private $idUser2;

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
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

    public function getIdUser1(): ?User
    {
        return $this->idUser1;
    }

    public function setIdUser1(?User $idUser1): self
    {
        $this->idUser1 = $idUser1;

        return $this;
    }

    public function getIdUser2(): ?User
    {
        return $this->idUser2;
    }

    public function setIdUser2(?User $idUser2): self
    {
        $this->idUser2 = $idUser2;

        return $this;
    }


}
