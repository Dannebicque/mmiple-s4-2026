<?php

namespace App\Controller;

use App\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "contact")]
    public function index(
        Request $request,
        MailerService $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, ['label' => 'Votre adresse email'])
            ->add('sujet', null, ['label' => 'Sujet du message'])
            ->add('message', TextareaType::class, ['label' => 'Votre message', 'attr' => ['rows' => 10]])
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mailer->sendMail(
                $form->get('email')->getData(),
                $form->get('sujet')->getData(),
                $form->get('message')->getData()
            );

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
