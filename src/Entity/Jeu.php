<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu")
 * @ORM\Entity(repositoryClass=JeuRepository::class)
 */
class Jeu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $idJeu;

    /**
     * @var int
     *
     * @ORM\Column(name="score_jeu", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $scoreJeu;

    /**
     * @var int
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $idQuiz;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $archive = '0';

    public function getIdJeu(): ?int
    {
        return $this->idJeu;
    }

    public function getScoreJeu(): ?int
    {
        return $this->scoreJeu;
    }

    public function setScoreJeu(int $scoreJeu): self
    {
        $this->scoreJeu = $scoreJeu;

        return $this;
    }

    public function getIdQuiz(): ?int
    {
        return $this->idQuiz;
    }

    public function setIdQuiz(int $idQuiz): self
    {
        $this->idQuiz = $idQuiz;

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