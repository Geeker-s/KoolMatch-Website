<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu")
 * @ORM\Entity
 */
class Jeu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJeu;

    /**
     * @var int
     *
     * @ORM\Column(name="score_jeu", type="integer", nullable=false)
     */
    private $scoreJeu;

    /**
     * @var int
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     */
    private $idQuiz;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
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
