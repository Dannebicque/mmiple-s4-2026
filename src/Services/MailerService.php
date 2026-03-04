<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer) {}

    public function sendMail(
        string $destinataire,
        string $sujet,
        string $messageTexte,
        string $messageHtml = ''
    )
    {
        if ($messageHtml === '') {
            $messageHtml = $messageTexte;
        }

        $email = (new Email())
            ->from('mail@mail.com')
            ->to($destinataire)
            ->subject($sujet)
            ->text($messageTexte)
            ->html($messageHtml);

        $this->mailer->send($email);

    }
}
