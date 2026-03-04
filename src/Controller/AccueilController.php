<?php

namespace App\Controller;

use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(
        EditeurRepository $editeurRepository
    ): Response
    {
        $editeurs = $editeurRepository->findByCodePostal('33000');

        $editeurs2 = $editeurRepository->findByNom();

        // $editeurs = $editeurRepository->findBy(['cp' => '33000']);
        // $editeurs2 = $editeurRepository->findAll();
        $date = new \DateTime();

        return $this->render('accueil/index.html.twig', [
            'message' => 'Page accueil',
            'date' => $date,
            'editeurs' => $editeurs,
        ]);
    }
}
