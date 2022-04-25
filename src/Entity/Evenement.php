<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="nom evenement doit etre non vide")
     * @Assert\Length(
     *      min = 3 ,
     *	    minMessage="Entrer un nom au minimum de 3 caracteres"
     *
     *      )
     */
    private $nomEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dd_event", type="date", nullable=false)
     */
    private $ddEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="df_event", type="date", nullable=false)
     * @Assert\Expression(
     *     "this.getDdEvent() < this.getDfEvent()",
     *     message="Date fin inférieur à date début")
     */
    private $dfEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_event", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Theme evenement doit etre non vide")
     */
    private $themeEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_event", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Adresse evenement doit etre non vide")
     *
     */
    private $adresseEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     * @Assert\Length(
     *      min = 8 ,
     *      max = 8 ,
     *	    minMessage="8 chiffres" ,
     *     maxMessage = "8 chiffres "
     *
     *      )
     */
    private $telephone;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
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

    public function getDdEvent(): ?\DateTimeInterface
    {
        return $this->ddEvent;
    }

    public function setDdEvent(\DateTimeInterface $ddEvent): self
    {
        $this->ddEvent = $ddEvent;

        return $this;
    }

    public function getDfEvent(): ?\DateTimeInterface
    {
        return $this->dfEvent;
    }

    public function setDfEvent(\DateTimeInterface $dfEvent): self
    {
        $this->dfEvent = $dfEvent;

        return $this;
    }

    public function getThemeEvent(): ?string
    {
        return $this->themeEvent;
    }

    public function setThemeEvent(string $themeEvent): self
    {
        $this->themeEvent = $themeEvent;

        return $this;
    }

    public function getAdresseEvent(): ?string
    {
        return $this->adresseEvent;
    }

    public function setAdresseEvent(string $adresseEvent): self
    {
        $this->adresseEvent = $adresseEvent;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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
