<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symdony\Component\Validator\Constraints\NotBlank;
use App\Repository\GerantRepository;


/**
 * Gerant
 *
 * @ORM\Table(name="gerant")
 * @ORM\Entity(repositoryClass=GerantRepository::class)
 */
class Gerant
{    protected $captchaCode;
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
     * @Assert\NotBlank(message="Nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage="Entrer un login au mini de 3 caracteres"
     *     )
     */
    private $nomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_gerant", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Prenom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage="Entrer un login au mini de 5 caracteres"
     *     )
     */
    private $prenomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="email_gerant", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Email doit etre non vide")
     * @Assert\Email(message="Adresse Email invalide")
     */
    private $emailGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="password_gerant", type="string", length=255, nullable=false)
     * @Assert\NotBlank (message=" Mot de passe doit etre non vide")
     * @Assert\Regex(
     *      pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
     *      message="Utiliser au moin une lettre Majiscule, une lettre miniscule et un nombre"
     * )
     */
    private $passwordGerant;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_gerant", type="integer", nullable=false)
     * @Assert\NotBlank (message="Ajoutez votre numéro de téléphone")
     * @Assert\Regex (
     *   pattern = "/(90|92|93|94|95|96|97|98|99|20|21|22|23|24|25|26|27|28|29|50|51|52|53|54|55|58|40|41|42|43)[0-9]{6}/"
     * )
     */
    private $telephoneGerant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dd_abonnement", type="date", nullable=false)
     * @Assert\NotBlank (message="Ajoutez la date de début d'abonnement")
     *      @Assert\Type(
     *      type = "\DateTime",
     *      message = "Date invalide",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "Date invalide "
     * )
     */
    private $ddAbonnement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="df_abonnement", type="date", nullable=false)
     * @Assert\NotBlank (message="Ajoutez la date de fin d'abonnement")
     *      @Assert\Type(
     *      type = "\DateTime",
     *      message = "Date invalide",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "Date invalide "
     * )
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
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

}
