<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\LessThanOrEqual("today",message="la date doit être inférieure a {{ compared_value }}.")
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

    public function getIdInteraction(): ?int
    {
        return $this->idInteraction;
    }

    public function getTypeInteraction(): ?string
    {
        return $this->typeInteraction;
    }

    public function setTypeInteraction(string $typeInteraction): self
    {
        $this->typeInteraction = $typeInteraction;

        return $this;
    }

    public function getDateInteraction(): ?\DateTimeInterface
    {
        return $this->dateInteraction;
    }

    public function setDateInteraction(\DateTimeInterface $dateInteraction): self
    {
        $this->dateInteraction = $dateInteraction;

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
