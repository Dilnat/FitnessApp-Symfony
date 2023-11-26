<?php
namespace App\Controller;

use App\Entity\Entrainement;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// ... autres imports nécessaires ...

class RemoveFromFavoritesController extends AbstractController
{
    #[Route('/api/utilisateurs/{id}/favoris', name: 'remove_from_favorites', methods: ['POST'])]
    public function __invoke(Request $request, Utilisateur $user, EntityManagerInterface $entityManager): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $trainingId = $requestData['entrainement_id'];

        $training = $entityManager->getRepository(Entrainement::class)->find($trainingId);

        if (!$training) {
            return $this->json(['message' => 'L\'entraînement avec cet ID n\'existe pas.'], Response::HTTP_NOT_FOUND);
        }

        $user->removeFavori($training);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => 'Entraînement enlevé aux favoris.'], Response::HTTP_CREATED);
    }
}