<?php
// src/Controller/AddTrainingToHistoryController.php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Entrainement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RemoveFromHistoriqueController extends AbstractController
{
    #[Route('/api/utilisateurs/{id}/historique', name: 'remove_from_history', methods: ['POST'])]
    public function __invoke(Request $request, Utilisateur $user, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'ID de l'entraînement à partir des données JSON
        $requestData = json_decode($request->getContent(), true);
        $trainingId = $requestData['entrainement_id']; // Assurez-vous que la clé correspond à celle dans le JSON

        // Récupérer l'entraînement à partir de l'ID
        $training = $entityManager->getRepository(Entrainement::class)->find($trainingId);

        // Vérifier si l'entraînement existe
        if (!$training) {
            return $this->json(['message' => 'L\'entraînement avec cet ID n\'existe pas.'], Response::HTTP_NOT_FOUND);
        }

        // Ajouter l'entraînement à l'historique de l'utilisateur
        $user->removeHistorique($training);

        // Persister les changements dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Retourner une réponse indiquant le succès
//        return $this->json(['message' => 'Entraînement ajouté à l\'historique de l\'utilisateur.'], Response::HTTP_CREATED);
        return $this->json(['message' => 'Entraînement enlevé à l\'historique de l\'utilisateur.'], Response::HTTP_CREATED);
    }
}
