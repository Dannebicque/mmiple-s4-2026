<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use App\Repository\JeuRepository;
use App\Services\JsonService;
use App\Services\UploadPhotoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuxController extends AbstractController
{
//    #[Route('/jeux', name: 'app_jeux')]
//    public function index(
//        JsonService $jsonService
//    ) : response
//    {
//        $jeux = $jsonService->lire('jeux.json');
//
//        return $this->render('jeux/index.html.twig', [
//            'jeux' => $jeux,
//        ]);
//    }
//
    #[Route('/jeux', name: 'app_jeux')]
    public function index(
        JeuRepository $jeuRepository
    ) : response
    {
        $form = $this->createForm(JeuType::class);
        $jeux = $jeuRepository->findAll();
        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
            'form_jeu' => $form->createView(),
            'date' => new \DateTime('2026-01-23')
        ]);
    }

    #[Route('/jeux/new', name: 'app_jeu_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        UploadPhotoService $uploadPhotoService
    ) : response
    {
        $jeu = new Jeu();
        $form = $this->createForm(JeuType::class, $jeu, [
            'codePostal' => '33000'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $uploadPhotoService->setRepertoireDestination($this->getParameter('kernel.project_dir') . '/public/images/jeux');
            $photo1 = $form->get('photo1')->getData();

            if ($photo1) {
                $nomPhoto1 = $uploadPhotoService->upload($photo1);
                $jeu->setPhoto1($nomPhoto1);
            }

            // photo2 et photo 3...


            // Persister et enregistrer le jeu dans la base de données
            $entityManager->persist($jeu);
            $entityManager->flush();
            // Rediriger vers une autre page (par exemple, la liste des jeux)
            return $this->redirectToRoute('app_jeux');
        }

        return $this->render('jeux/new.html.twig', [
            'form_jeu' => $form->createView(),
        ]);
    }

    #[Route('/jeux/{id}/modif', name: 'app_jeu_modif')]
    public function modif(
        int $id,
        Request $request,
        EntityManagerInterface $entityManager
    ) : response
    {
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);

        if (!$jeu) {
            throw $this->createNotFoundException('Jeu Inexistant');
        }

        $form = $this->createForm(JeuType::class, $jeu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Persister et enregistrer le jeu dans la base de données
            $entityManager->persist($jeu);
            $entityManager->flush();
            // Rediriger vers une autre page (par exemple, la liste des jeux)
            return $this->redirectToRoute('app_fiche', ['code' => $jeu->getId()]);
        }

        return $this->render('jeux/modif.html.twig', [
            'form_jeu' => $form->createView(),
            'jeu' => $jeu
        ]);
    }

    #[Route('/jeu/{id}/supprime', name: 'app_jeu_supprime', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function supprime(int $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'entité Jeu existante
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);

        // Vérifier si le jeu existe
        if (!$jeu) {
            throw $this->createNotFoundException('Jeu Inexistant');
        }

        // Supprimer le jeu de la base de données
        $entityManager->remove($jeu);
        $entityManager->flush();

        // Rediriger vers la liste des jeux après la suppression
        return $this->redirectToRoute('app_jeux');
    }

    #[Route('/fiche/{code}', name: 'app_fiche', requirements: ['code'=>'\d+'])]
    public function fiche(
        JeuRepository $jeuRepository,
        int $code ) : Response
    {
        $jeu = $jeuRepository->find($code);

        return $this->render('jeux/fiche.html.twig', [
            'jeu' => $jeu
        ]);
    }
}
