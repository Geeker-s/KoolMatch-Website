<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuiz;

    /**
     * @var int
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=false)
     */
    private $idJeu;

    /**
     * @var string
     *
     * @ORM\Column(name="Q1", type="text", length=65535, nullable=false)
     */
    private $q1;

    /**
     * @var string
     *
     * @ORM\Column(name="rc1", type="text", length=65535, nullable=false)
     */
    private $rc1;

    /**
     * @var string
     *
     * @ORM\Column(name="rf11", type="text", length=65535, nullable=false)
     */
    private $rf11;

    /**
     * @var string
     *
     * @ORM\Column(name="rf12", type="text", length=65535, nullable=false)
     */
    private $rf12;

    /**
     * @var string
     *
     * @ORM\Column(name="rf13", type="text", length=65535, nullable=false)
     */
    private $rf13;

    /**
     * @var string
     *
     * @ORM\Column(name="Q2", type="text", length=65535, nullable=false)
     */
    private $q2;

    /**
     * @var string
     *
     * @ORM\Column(name="rc2", type="text", length=65535, nullable=false)
     */
    private $rc2;

    /**
     * @var string
     *
     * @ORM\Column(name="rf21", type="text", length=65535, nullable=false)
     */
    private $rf21;

    /**
     * @var string
     *
     * @ORM\Column(name="rf22", type="text", length=65535, nullable=false)
     */
    private $rf22;

    /**
     * @var string
     *
     * @ORM\Column(name="rf23", type="text", length=65535, nullable=false)
     */
    private $rf23;

    /**
     * @var string
     *
     * @ORM\Column(name="Q3", type="text", length=65535, nullable=false)
     */
    private $q3;

    /**
     * @var string
     *
     * @ORM\Column(name="rc3", type="text", length=65535, nullable=false)
     */
    private $rc3;

    /**
     * @var string
     *
     * @ORM\Column(name="rf31", type="text", length=65535, nullable=false)
     */
    private $rf31;

    /**
     * @var string
     *
     * @ORM\Column(name="rf32", type="text", length=65535, nullable=false)
     */
    private $rf32;

    /**
     * @var string
     *
     * @ORM\Column(name="rf33", type="text", length=65535, nullable=false)
     */
    private $rf33;

    /**
     * @var int|null
     *
     * @ORM\Column(name="archive", type="integer", nullable=true)
     */
    private $archive = '0';


}
