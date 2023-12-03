<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['exercice:read']]
)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['exercice:read','entrainement:read','entrainements:read'])]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: GroupeMusculaire::class, fetch: "EAGER")]
    #[ORM\JoinTable(name:"exercice_groupeMusculaire")]
    #[Groups(['exercice:read','entrainement:read'])]
    private Collection $groupeMusculaire;

    #[ORM\ManyToOne(fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['exercice:read','entrainement:read'])]
    private ?TypeExercice $typeExercice = null;

    #[ORM\ManyToOne(fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['exercice:read','entrainement:read'])]
    private ?Niveau $difficulte = null;

    #[ORM\Column]
    #[Groups(['exercice:read','entrainement:read'])]
    private array $equipement = [];

    #[ORM\Column]
    #[Groups(['exercice:read','entrainements:read','entrainement:read'])]
    private ?int $tempsExo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['exercice:read','entrainement:read'])]
    private ?string $photo = null;

    #[ORM\Column]
    #[Groups(['exercice:read','entrainements:read','entrainement:read'])]
    private ?int $kcal = null;

    #[ORM\Column]
    #[Groups(['exercice:read','entrainements:read','entrainement:read'])]
    private ?int $reposApresExo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['exercice:read','entrainements:read','entrainement:read'])]
    private ?string $nom = null;

    public function __construct()
    {
        $this->groupeMusculaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, GroupeMusculaire>
     */
    public function getGroupeMusculaire(): Collection
    {
        return $this->groupeMusculaire;
    }

    public function addGroupeMusculaire(GroupeMusculaire $groupeMusculaire): static
    {
        if (!$this->groupeMusculaire->contains($groupeMusculaire)) {
            $this->groupeMusculaire->add($groupeMusculaire);
        }

        return $this;
    }

    public function removeGroupeMusculaire(GroupeMusculaire $groupeMusculaire): static
    {
        $this->groupeMusculaire->removeElement($groupeMusculaire);

        return $this;
    }

    public function getTypeExercice(): ?TypeExercice
    {
        return $this->typeExercice;
    }

    public function setTypeExercice(?TypeExercice $typeExercice): static
    {
        $this->typeExercice = $typeExercice;

        return $this;
    }

    public function getDifficulte(): ?Niveau
    {
        return $this->difficulte;
    }

    public function setDifficulte(?Niveau $difficulte): static
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getEquipement(): array
    {
        return $this->equipement;
    }

    public function setEquipement(array $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getTempsExo(): ?int
    {
        return $this->tempsExo;
    }

    public function setTempsExo(int $tempsExo): static
    {
        $this->tempsExo = $tempsExo;

        return $this;
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

    public function getKcal(): ?int
    {
        return $this->kcal;
    }

    public function setKcal(int $kcal): static
    {
        $this->kcal = $kcal;

        return $this;
    }

    public function getReposApresExo(): ?int
    {
        return $this->reposApresExo;
    }

    public function setReposApresExo(int $reposApresExo): static
    {
        $this->reposApresExo = $reposApresExo;

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
}
