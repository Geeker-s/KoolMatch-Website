<?php

namespace App\Entity;
use App\Repository\QuizRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz", indexes={@ORM\Index(name="fk_r", columns={"id_recette"})})
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $idQuiz;

    /**
     * @var string
     *
     * @ORM\Column(name="Q1", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la question est obligatoire")
     * @Assert\Length(min=3,minMessage= "la question doit contenir au moins  {{ limit }} caractères.")
     *@Groups("post:read")
     */
    private $q1;

    /**
     * @var string
     *
     * @ORM\Column(name="rc1", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la question est obligatoire")
     * @Assert\Length(min=3,minMessage= "la question doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rc1;

    /**
     * @var string
     *
     * @ORM\Column(name="rf11", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf11;

    /**
     * @var string
     *
     * @ORM\Column(name="rf12", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf12;

    /**
     * @var string
     *
     * @ORM\Column(name="rf13", type="text", length=65535, nullable=false)
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf13;

    /**
     * @var string
     *
     * @ORM\Column(name="Q2", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la question est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $q2;

    /**
     * @var string
     *
     * @ORM\Column(name="rc2", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la question doit contenir au moins  {{ limit }} caractères.")
     *@Groups("post:read")
     */
    private $rc2;

    /**
     * @var string
     *@Assert\NotBlank(message="la reponse est obligatoire")
     * @ORM\Column(name="rf21", type="text", length=65535, nullable=false)
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf21;

    /**
     * @var string
     *@Assert\NotBlank(message="la reponse est obligatoire")
     * @ORM\Column(name="rf22", type="text", length=65535, nullable=false)
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf22;

    /**
     * @var string
     *@Assert\NotBlank(message="la reponse est obligatoire")
     * @ORM\Column(name="rf23", type="text", length=65535, nullable=false)
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf23;

    /**
     * @var string
     *@Assert\NotBlank(message="la reponse est obligatoire")
     * @ORM\Column(name="Q3", type="text", length=65535, nullable=false)
     * @Assert\Length(min=3,minMessage= "la question doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $q3;

    /**
     * @var string
     *
     * @ORM\Column(name="rc3", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la question est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rc3;

    /**
     * @var string
     *
     * @ORM\Column(name="rf31", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf31;

    /**
     * @var string
     *
     * @ORM\Column(name="rf32", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf32;

    /**
     * @var string
     *
     * @ORM\Column(name="rf33", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="la reponse est obligatoire")
     * @Assert\Length(min=3,minMessage= "la réponse doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $rf33;

    /**
     * @var int|null
     *
     * @ORM\Column(name="archive", type="integer", nullable=true)
     * @Groups("post:read")
     */
    private $archive = '0';

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recette", referencedColumnName="id_recette")
     * })
     * @Groups("post:read")
     */
    protected $idRecette;

    /**
     * @return int
     */
    public function getIdQuiz(): int
    {
        return $this->idQuiz;
    }

    /**
     * @param int $idQuiz
     */
    public function setIdQuiz(int $idQuiz): void
    {
        $this->idQuiz = $idQuiz;
    }

    public function getQ1(): ?string
    {
        return $this->q1;
    }

    public function setQ1(string $q1): self
    {
        $this->q1 = $q1;

        return $this;
    }

    public function getRc1(): ?string
    {
        return $this->rc1;
    }

    public function setRc1(string $rc1): self
    {
        $this->rc1 = $rc1;

        return $this;
    }

    public function getRf11(): ?string
    {
        return $this->rf11;
    }

    public function setRf11(string $rf11): self
    {
        $this->rf11 = $rf11;

        return $this;
    }

    public function getRf12(): ?string
    {
        return $this->rf12;
    }

    public function setRf12(string $rf12): self
    {
        $this->rf12 = $rf12;

        return $this;
    }

    public function getRf13(): ?string
    {
        return $this->rf13;
    }

    public function setRf13(string $rf13): self
    {
        $this->rf13 = $rf13;

        return $this;
    }

    public function getQ2(): ?string
    {
        return $this->q2;
    }

    public function setQ2(string $q2): self
    {
        $this->q2 = $q2;

        return $this;
    }

    public function getRc2(): ?string
    {
        return $this->rc2;
    }

    public function setRc2(string $rc2): self
    {
        $this->rc2 = $rc2;

        return $this;
    }

    public function getRf21(): ?string
    {
        return $this->rf21;
    }

    public function setRf21(string $rf21): self
    {
        $this->rf21 = $rf21;

        return $this;
    }

    public function getRf22(): ?string
    {
        return $this->rf22;
    }

    public function setRf22(string $rf22): self
    {
        $this->rf22 = $rf22;

        return $this;
    }

    public function getRf23(): ?string
    {
        return $this->rf23;
    }

    public function setRf23(string $rf23): self
    {
        $this->rf23 = $rf23;

        return $this;
    }

    public function getQ3(): ?string
    {
        return $this->q3;
    }

    public function setQ3(string $q3): self
    {
        $this->q3 = $q3;

        return $this;
    }

    public function getRc3(): ?string
    {
        return $this->rc3;
    }

    public function setRc3(string $rc3): self
    {
        $this->rc3 = $rc3;

        return $this;
    }

    public function getRf31(): ?string
    {
        return $this->rf31;
    }

    public function setRf31(string $rf31): self
    {
        $this->rf31 = $rf31;

        return $this;
    }

    public function getRf32(): ?string
    {
        return $this->rf32;
    }

    public function setRf32(string $rf32): self
    {
        $this->rf32 = $rf32;

        return $this;
    }

    public function getRf33(): ?string
    {
        return $this->rf33;
    }

    public function setRf33(string $rf33): self
    {
        $this->rf33 = $rf33;

        return $this;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(?int $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getIdRecette(): ?Recette
    {
        return $this->idRecette;
    }

    public function setIdRecette(?Recette $idRecette): self
    {
        $this->idRecette = $idRecette;

        return $this;
    }


}
