<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\AddToFavoritesController;
use App\Controller\AddTrainingToHistoryController;
use App\Repository\UtilisateurRepository;
use App\State\UtilisateurProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Delete(security: "object == user"),
        new Post(denormalizationContext: ["groups" => ["utilisateur:create"]],
            validationContext: ["groups" => ["Default", "utilisateur:create"]], processor: UtilisateurProcessor::class),
        new Patch(denormalizationContext: ["groups" => ["utilisateur:update"]],
            security: "object == user",
            validationContext: ["groups" => ["Default", "utilisateur:update"]],
            processor: UtilisateurProcessor::class),
        new Post(
            uriTemplate: '/utilisateurs/{id}/historique',
            controller: AddTrainingToHistoryController::class,
            security: "object == user"),
        new Post(
            uriTemplate: '/utilisateurs/{id}/favoris',
            controller: AddToFavoritesController::class,
            security: "object == user"),
    ], normalizationContext: ["groups" => ["utilisateur:read"]],
)]
#[UniqueEntity('mail', message: "Mail déjà utilisé")]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['utilisateur:read', 'entrainement:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'entrainement:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'entrainement:read'])]
    private ?string $prenom = null;

    #[ApiProperty(readable: false, writable: false)]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotNull(groups: ['utilisateur:create'])]
    #[Assert\NotBlank(groups: ['utilisateur:create'])]
    #[Assert\Length(min: 8, max: 30, minMessage: "Minimum 8 caractères", maxMessage: "Maximum 30 caractères", groups: ['utilisateur:create'])]
    #[Assert\Regex(pattern: "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,30}$#", message: "Mot de passe non valide", groups: ['utilisateur:create'])]
    #[Groups(['utilisateur:create', 'utilisateur:update'])]
    private ?string $plainPassword = '';

    #[ORM\Column]
    private array $roles = [];

    #[Assert\NotNull(groups: ['utilisateur:create'])]
    #[Assert\NotBlank(groups: ['utilisateur:create'])]
    #[Assert\Email(message: 'Mail non valide', groups: ['utilisateur:create'])]
    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['utilisateur:read', 'utilisateur:create', 'utilisateur:update'])]
    private ?string $mail = null;

    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private ?int $taille = null;

    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private ?int $poids = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['utilisateur:read'])]
    private ?Niveau $niveau = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['utilisateur:read'])]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\ManyToMany(targetEntity: Medaille::class)]
    #[ORM\JoinTable(name: "Recompense")]
    private Collection $medaille;

    #[ORM\ManyToMany(targetEntity: Entrainement::class)]
    #[ORM\JoinTable(name: "Favori")]
    private Collection $favoris;

    #[ORM\ManyToMany(targetEntity: Entrainement::class)]
    #[ORM\JoinTable(name: "Historique")]
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

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->mail;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }


}
