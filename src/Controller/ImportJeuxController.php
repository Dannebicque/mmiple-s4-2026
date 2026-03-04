<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Services\JsonService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ImportJeuxController extends AbstractController
{
    #[Route('/import', name: 'app_import_jeux')]
    public function index(
        JsonService $jsonService,
        EntityManagerInterface $entityManager
    ): Response
    {
       $jeux = $jsonService->lire('jeux.json');
       foreach ($jeux as $item) {
           $jeu = new Jeu() ;
           // Affectation des données aux attributs
           // Correspondance des Setters et des noms dans le tableau $jeux
           $jeu->setNom($item['jeu_nom']);
           $jeu->setDuree($item['jeu_duree_partie']);
           $jeu->setMini($item['jeu_nb_joueurs_mini']);
           $jeu->setMaxi($item['jeu_nb_joueurs_maxi']);
           $jeu->setPhoto1($item['jeu_photo1']);
           $jeu->setPhoto2($item['jeu_photo2']);
           $jeu->setPhoto3($item['jeu_photo3']);
           $jeu->setPrix($item['jeu_prix_unit']);
           $jeu->setStock($item['jeu_qte_stock']);
           $entityManager->persist($jeu);
       }
       $entityManager->flush();

       return new Response('Importation réussie, ouvrez phpMyAdmin pour vérifier');
    }
}
