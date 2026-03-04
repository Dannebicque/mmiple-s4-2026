<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo3 = null;

    #[ORM\Column]
    private ?int $mini = null;

    #[ORM\Column()]
    private ?int $maxi = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'jeux')]
    private ?Editeur $editeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = strtoupper($nom);

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto1(): ?string
    {
        return $this->photo1;
    }

    public function setPhoto1(?string $photo1): static
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(?string $photo2): static
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(?string $photo3): static
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getMini(): ?int
    {
        return $this->mini;
    }

    public function setMini(int $mini): static
    {
        $this->mini = $mini;

        return $this;
    }

    public function getMaxi(): ?int
    {
        return $this->maxi;
    }

    public function setMaxi(int $maxi): static
    {
        $this->maxi = $maxi;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }
}
