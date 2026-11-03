<?php

namespace App\Controller;

use App\Repository\AnimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(AnimeRepository $animeRepository): Response
    {
        $animes = $animeRepository->findAll();
        return $this->render('catalogue/index.html.twig', [
            'animes' => $animes,
        ]);
    }
}
