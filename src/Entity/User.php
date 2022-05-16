<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
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
{
    protected $captchaCode;
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("algorithme")
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
     * @Groups("algorithme")
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_user", type="string", length=20, nullable=false)
     */
    private $prenomUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance_user", type="date", nullable=false)
     */
    private $datenaissanceUser;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe_user", type="string", length=20, nullable=false)
     */
    private $sexeUser;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone_user", type="integer", nullable=false)
     */
    private $telephoneUser;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_user", type="string", length=100, nullable=false)
     * @Groups("algorithme")
     */
    private $photoUser;

    /**
     * @var string
     *
     * @ORM\Column(name="description_user", type="string", length=100, nullable=false)
     * @Groups("algorithme")
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
     * @Groups("algorithme")
     */
    private $adresseUser = 'x';

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true)
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

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=300,nullable=true)
     */
    private $Reset_Token;

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

    //added by wassim
    public function getAge()
    {
        $dateInterval = $this->datenaissanceUser->diff(new \DateTime());
        return $dateInterval->y;
    }

    public static function distance($lat1, $lng1, $lat2, $lng2) {
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $meter = ($earth_radius * $d);
        return round($meter / 1000);
    }

    public function updateU($distance,$age,$ageMax){
        $this->setMaxdistanceUser( intval($distance));
        $this->setPreferredmaxageUser(intval($ageMax));
        $this->setPreferredminageUser(intval($age));
    }

    //Ending wassim function


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

    public function getResetToken(): ?string
    {
        return $this->Reset_Token;
    }

    public function setResetToken(string $Reset_Token): self
    {
        $this->Reset_Token = $Reset_Token;

        return $this;
    }



}
