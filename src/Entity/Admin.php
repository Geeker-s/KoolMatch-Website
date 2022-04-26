<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symdony\Component\Validator\Constraints\NotBlank;
use App\Repository\AdminRepository;


/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{  protected $captchaCode;
    /**
     * @var int
     *
     * @ORM\Column(name="id_admin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdmin;

    /**
     * @var string
     * @ORM\Column(name="login_admin", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Login doit etre non vide")
     * @Assert\Length(min = 5,minMessage="Entrer un login au mini de 5 caracteres")
     */
    private $loginAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="password_admin", type="string", length=20, nullable=false)
     * @Assert\NotBlank (message=" Mot de passe doit etre non vide")
     * @Assert\Regex(
     *      pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
     *      message="Utiliser au moin une lettre Majiscule, une lettre miniscule et un nombre"
     * )
     */
    private $passwordAdmin;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     */
    private $archive = '0';


    public function getIdAdmin(): ?int
    {
        return $this->idAdmin;
    }

    public function getLoginAdmin(): ?string
    {
        return $this->loginAdmin;
    }

    public function setLoginAdmin(string $loginAdmin): self
    {
        $this->loginAdmin = $loginAdmin;

        return $this;
    }

    public function getPasswordAdmin(): ?string
    {
        return $this->passwordAdmin;
    }

    public function setPasswordAdmin(string $passwordAdmin): self
    {
        $this->passwordAdmin = $passwordAdmin;

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