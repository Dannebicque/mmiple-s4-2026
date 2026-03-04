<?php

namespace App\Controller;

use App\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MailController extends AbstractController
{
    #[Route("/mail", name:"mail")]
    public function index(MailerService $mailer): Response
    {
        $mailer->sendMail(
            'mondest@mail.com',
            'essai d\'un sujet',
            'ceci est un message en texte brut',
            '<h1>ceci est un message en HTML</h1>'
        );

        return $this->render('mail/index.html.twig', []);

    }
}
