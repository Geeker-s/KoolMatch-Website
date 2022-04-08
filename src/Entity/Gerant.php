<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gerant
 *
 * @ORM\Table(name="gerant")
 * @ORM\Entity
 */
class Gerant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_gerant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_gerant", type="string", length=100, nullable=false)
     */
    private $nomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_gerant", type="string", length=100, nullable=false)
     */
    private $prenomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="email_gerant", type="string", length=255, nullable=false)
     */
    private $emailGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="password_gerant", type="string", length=255, nullable=false)
     */
    private $passwordGerant;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_gerant", type="integer", nullable=false)
     */
    private $telephoneGerant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dd_abonnement", type="date", nullable=false)
     */
    private $ddAbonnement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="df_abonnement", type="date", nullable=false)
     */
    private $dfAbonnement;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';

    public function getIdGerant(): ?int
    {
        return $this->idGerant;
    }

    public function getNomGerant(): ?string
    {
        return $this->nomGerant;
    }

    public function setNomGerant(string $nomGerant): self
    {
        $this->nomGerant = $nomGerant;

        return $this;
    }

    public function getPrenomGerant(): ?string
    {
        return $this->prenomGerant;
    }

    public function setPrenomGerant(string $prenomGerant): self
    {
        $this->prenomGerant = $prenomGerant;

        return $this;
    }

    public function getEmailGerant(): ?string
    {
        return $this->emailGerant;
    }

    public function setEmailGerant(string $emailGerant): self
    {
        $this->emailGerant = $emailGerant;

        return $this;
    }

    public function getPasswordGerant(): ?string
    {
        return $this->passwordGerant;
    }

    public function setPasswordGerant(string $passwordGerant): self
    {
        $this->passwordGerant = $passwordGerant;

        return $this;
    }

    public function getTelephoneGerant(): ?int
    {
        return $this->telephoneGerant;
    }

    public function setTelephoneGerant(int $telephoneGerant): self
    {
        $this->telephoneGerant = $telephoneGerant;

        return $this;
    }

    public function getDdAbonnement(): ?\DateTimeInterface
    {
        return $this->ddAbonnement;
    }

    public function setDdAbonnement(\DateTimeInterface $ddAbonnement): self
    {
        $this->ddAbonnement = $ddAbonnement;

        return $this;
    }

    public function getDfAbonnement(): ?\DateTimeInterface
    {
        return $this->dfAbonnement;
    }

    public function setDfAbonnement(\DateTimeInterface $dfAbonnement): self
    {
        $this->dfAbonnement = $dfAbonnement;

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
