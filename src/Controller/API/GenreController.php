<?php

namespace App\Controller\API;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/admin/api/genres')]
#[IsGranted('ROLE_ADMIN')]
class GenreController extends AbstractController
{
    // RENVOYER : la liste
    #[Route('', name: 'api_genre_index', methods: ['GET'])]
    public function index(GenreRepository $genreRepository): JsonResponse
    {
        return $this->json($genreRepository->findAll(), 200, [], [
            'groups' => 'api_genre_index',
        ]);
    }

    // RENVOYER : un seul genre
    #[Route('/{id}', name: 'api_genre_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Genre $genre): JsonResponse
    {
        return $this->json($genre, 200, [], [
            'groups' => 'api_genre_index',
        ]);
    }

    // RECEVOIR : créer un genre
    #[Route('/new', name: 'api_genre_new', methods: ['POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator,
        ValidatorInterface $validator
    ): JsonResponse {
        // 1. Déserialiser : JSON reçu -> objet Genre
        $genre = $serializer->deserialize($request->getContent(), Genre::class, 'json', [
            'groups' => 'api_genre_index',
        ]);

        // 2. Valider
        $errors = $validator->validate($genre);
        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }

            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // 3. Enregistrer
        $em->persist($genre);
        $em->flush();

        // 4. Répondre avec l'objet créé et son URL
        $url = $urlGenerator->generate('api_genre_show', ['id' => $genre->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->json($genre, Response::HTTP_CREATED, ['Location' => $url], [
            'groups' => 'api_genre_index',
        ]);
    }
}
