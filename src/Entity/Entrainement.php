<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Repository\EntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntrainementRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/utilisateurs/{id}/historique',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'historique',
                    fromClass: Utilisateur::class
                )
            ],
        ),
        new GetCollection(
            uriTemplate: '/utilisateurs/{id}/favoris',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'favoris',
                    fromClass: Utilisateur::class
                )
            ],
        ),
    ]
    , normalizationContext: ["groups" => ["entrainement:read"]],
)]
#[ApiResource]
class Entrainement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['entrainement:read'])]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Exercice::class, fetch: "EAGER")]
    #[ORM\JoinTable(name:"exercices_par_entrainement")]
    #[Groups(['entrainement:read'])]
    private Collection $exercices;

    #[ORM\Column(length: 255)]
    #[Groups(['entrainement:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['entrainement:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['entrainement:read'])]
    private ?Utilisateur $createur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['entrainement:read'])]
    private ?\DateTimeInterface $dateAjout = null;

    #[ORM\Column(length: 255)]
    #[Groups(['entrainement:read'])]
    private ?string $image = null;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        $this->exercices->removeElement($exercice);

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateur(): ?Utilisateur
    {
        return $this->createur;
    }

    public function setCreateur(?Utilisateur $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
