<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recette", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $idRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recette", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="le nom est obligatoire")
     * @Assert\Length(min=3,minMessage= "le nom doit contenir au moins  {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $nomRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_recette", type="string", length=255, nullable=false)
     * @Assert\Image()
     * @Groups("post:read")
     */
    private $photoRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="description_recette", type="string", length=255, nullable=false)
     * @Assert\Length(min=4 , minMessage= "la description doit contenir au moins {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $descriptionRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_recette", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="categorie est obligatoire")
     * @Assert\Length(min=3,minMessage= "la categorie doit contenir au moins {{ limit }} caractères.")
     * @Groups("post:read")
     */
    private $categorieRecette;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_recette", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $dureeRecette;

    /**
     * @var int
     *
     * @ORM\Column(name="archive", type="integer", nullable=false)
     * @Assert\NotBlank(message="la duree est obligatoire")
     * @Groups("post:read")
     */
    private $archive = '0';

    public function getIdRecette(): ?int
    {
        return $this->idRecette;
    }

    public function getNomRecette(): ?string
    {
        return $this->nomRecette;
    }

    public function setNomRecette(string $nomRecette): self
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    public function getPhotoRecette(): ?string
    {
        return $this->photoRecette;
    }

    public function setPhotoRecette(string $photoRecette): self
    {
        $this->photoRecette = $photoRecette;

        return $this;
    }

    public function getDescriptionRecette(): ?string
    {
        return $this->descriptionRecette;
    }

    public function setDescriptionRecette(string $descriptionRecette): self
    {
        $this->descriptionRecette = $descriptionRecette;

        return $this;
    }

    public function getCategorieRecette(): ?string
    {
        return $this->categorieRecette;
    }

    public function setCategorieRecette(string $categorieRecette): self
    {
        $this->categorieRecette = $categorieRecette;

        return $this;
    }

    public function getDureeRecette(): ?int
    {
        return $this->dureeRecette;
    }

    public function setDureeRecette(int $dureeRecette): self
    {
        $this->dureeRecette = $dureeRecette;

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