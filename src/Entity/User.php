<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oh\GoogleMapFormTypeBundle\Traits\LocationTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symdony\Component\Validator\Constraints\NotBlank;
use App\Repository\UserRepository;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{   protected $captchaCode;
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Email doit etre non vide")
     * @Assert\Email(message="Adresse Email invalide")
     */
    private $emailUser;

    /**
     * @var string
     *
     * @ORM\Column(name="password_user", type="string", length=20, nullable=false)
     * @Assert\NotBlank (message=" Mot de passe doit etre non vide")
     * @Assert\Regex(
     *      pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
     *      message="Utiliser au moin une lettre Majiscule, une lettre miniscule et un nombre"
     * )
     */
    private $passwordUser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage="Entrer un nom au mini de 3 caracteres"
     *     )
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_user", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Prenom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage="prénom invalide "
     *     )
     */
    private $prenomUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance_user", type="date", nullable=false)
     * @Assert\NotBlank(message="Ajoutez votre date de naissance")
     */
    private $datenaissanceUser;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe_user", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Sélectionnez votre sexe")
     */
    private $sexeUser;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_user", type="integer", nullable=false)
     * @Assert\NotBlank (message="Ajoutez votre numéro de téléphone")
     * @Assert\Regex (
     *   pattern = "/(90|92|93|94|95|96|97|98|99|20|21|22|23|24|25|26|27|28|29|50|51|52|53|54|55|58|40|41|42|43)[0-9]{6}/"
     * )
     */
    private $telephoneUser;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_user", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Ajoutez une photo")
     */
    private $photoUser;

    /**
     * @var string
     *
     * @ORM\Column(name="description_user", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Ajoutez une description")
     * @Assert\Length(
     *      min = 10,
     *      minMessage="Votre description est courte "
     *     )
     */
    private $descriptionUser;

    /**
     * @var int
     *
     * @ORM\Column(name="maxDistance_user", type="integer", nullable=false)
     */
    private $maxdistanceUser;

    /**
     * @var int
     *
     * @ORM\Column(name="preferredMinAge_user", type="integer", nullable=false)
     */
    private $preferredminageUser;

    /**
     * @var int
     *
     * @ORM\Column(name="preferredMaxAge_user", type="integer", nullable=false)
     */
    private $preferredmaxageUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_user", type="string", length=255, nullable=false, options={"default"="x"})
     */
    private $adresseUser = 'x';

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="Interet_user", type="integer", nullable=false)
     */
    private $interetUser;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->emailUser = $emailUser;

        return $this;
    }

    public function getPasswordUser(): ?string
    {
        return $this->passwordUser;
    }

    public function setPasswordUser(string $passwordUser): self
    {
        $this->passwordUser = $passwordUser;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): self
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getDatenaissanceUser(): ?\DateTimeInterface
    {
        return $this->datenaissanceUser;
    }

    public function setDatenaissanceUser(\DateTimeInterface $datenaissanceUser): self
    {
        $this->datenaissanceUser = $datenaissanceUser;

        return $this;
    }

    public function getSexeUser(): ?string
    {
        return $this->sexeUser;
    }

    public function setSexeUser(string $sexeUser): self
    {
        $this->sexeUser = $sexeUser;

        return $this;
    }

    public function getTelephoneUser(): ?int
    {
        return $this->telephoneUser;
    }

    public function setTelephoneUser(int $telephoneUser): self
    {
        $this->telephoneUser = $telephoneUser;

        return $this;
    }

    public function getPhotoUser()
    {
        return $this->photoUser;
    }

    public function setPhotoUser( $photoUser)
    {
        $this->photoUser = $photoUser;

        return $this;
    }

    public function getDescriptionUser(): ?string
    {
        return $this->descriptionUser;
    }

    public function setDescriptionUser(string $descriptionUser): self
    {
        $this->descriptionUser = $descriptionUser;

        return $this;
    }

    public function getMaxdistanceUser(): ?int
    {
        return $this->maxdistanceUser;
    }

    public function setMaxdistanceUser(int $maxdistanceUser): self
    {
        $this->maxdistanceUser = $maxdistanceUser;

        return $this;
    }

    public function getPreferredminageUser(): ?int
    {
        return $this->preferredminageUser;
    }

    public function setPreferredminageUser(int $preferredminageUser): self
    {
        $this->preferredminageUser = $preferredminageUser;

        return $this;
    }

    public function getPreferredmaxageUser(): ?int
    {
        return $this->preferredmaxageUser;
    }

    public function setPreferredmaxageUser(int $preferredmaxageUser): self
    {
        $this->preferredmaxageUser = $preferredmaxageUser;

        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresseUser;
    }

    public function setAdresseUser(string $adresseUser): self
    {
        $this->adresseUser = $adresseUser;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getInteretUser(): ?int
    {
        return $this->interetUser;
    }

    public function setInteretUser(int $interetUser): self
    {
        $this->interetUser = $interetUser;

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
