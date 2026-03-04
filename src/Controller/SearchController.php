<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(
        Request $request,
        JeuRepository $jeuRepository
    ): Response
    {
        $jeux = [];
        if ($request->isMethod('POST')) {
            $texte = $request->request->get('texte');
            $jeux = $jeuRepository->findByNom($texte);
        }


        return $this->render('search/index.html.twig', [
            'jeux' => $jeux
        ]);
    }
}
