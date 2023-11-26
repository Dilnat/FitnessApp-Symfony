<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Repository\MedailleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedailleRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/utilisateurs/{id}/medailles',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'medaille',
                    fromClass: Utilisateur::class
                )
            ],
        ),
    ]
)]
class Medaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

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
        $this->nom = $nom;

        return $this;
    }
}
