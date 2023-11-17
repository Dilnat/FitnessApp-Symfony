<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\ManyToMany(targetEntity: Medaille::class)]
    private Collection $medaille;

    #[ORM\ManyToMany(targetEntity: Entrainement::class)]
    private Collection $favoris;

    #[ORM\ManyToMany(targetEntity: Entrainement::class)]
    private Collection $historique;


    public function __construct()
    {
        $this->medaille = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->historique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * @return Collection<int, Medaille>
     */
    public function getMedaille(): Collection
    {
        return $this->medaille;
    }

    public function addMedaille(Medaille $medaille): static
    {
        if (!$this->medaille->contains($medaille)) {
            $this->medaille->add($medaille);
        }

        return $this;
    }

    public function removeMedaille(Medaille $medaille): static
    {
        $this->medaille->removeElement($medaille);

        return $this;
    }

    /**
     * @return Collection<int, Entrainement>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Entrainement $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
        }

        return $this;
    }

    public function removeFavori(Entrainement $favori): static
    {
        $this->favoris->removeElement($favori);

        return $this;
    }

    /**
     * @return Collection<int, Entrainement>
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(Entrainement $historique): static
    {
        if (!$this->historique->contains($historique)) {
            $this->historique->add($historique);
        }

        return $this;
    }

    public function removeHistorique(Entrainement $historique): static
    {
        $this->historique->removeElement($historique);

        return $this;
    }
}
