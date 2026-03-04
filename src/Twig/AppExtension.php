<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', $this->formatPrice(...)),
            new TwigFilter('dateFr', $this->dateFr(...)),
            new TwigFilter('phoneNumber', $this->phoneNumber(...)),
            new TwigFilter('stars', $this->stars(...), ['is_safe' => ['html']]),

        ];
    }

    public function dateFr(\DateTime|string $date = 'now') : string {

        if ($date === 'now') {
            $date = new \DateTime();
        }

        return $date->format('d/m/Y');
    }

    public function phoneNumber(string $phone): string
    {
        // Format FR avec ou sans indicatif international avec des . :
        // 0678965435 => 06.78.96.54.35
        // +33678965435 => +33.(0)6.78.96.54.35

        $digits = preg_replace('/\D+/', '', $phone);

        // Cas +33...
        if (str_starts_with($phone, '+')) {
            // On ne gère ici que l'indicatif 33 (FR)
            if (str_starts_with($digits, '33')) {
                $national = substr($digits, 2);      // ex: 678965435
                $national = ltrim($national, '0');   // au cas où: 0...

                // Découpe en groupes de 2, en gardant éventuellement 1 chiffre au début
                $first = substr($national, 0, 1);    // ex: "6"
                $rest  = substr($national, 1);       // ex: "78965435"
                $pairs = $rest !== '' ? implode('.', str_split($rest, 2)) : '';

                return '+33.(0)'.$first.($pairs !== '' ? '.'.$pairs : '');
            }
        }

        // Cas 0X...
        return preg_replace('/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/', '$1.$2.$3.$4.$5', $digits);
    }
    public function formatPrice($number, $symbol = '€', $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price. ' '.$symbol; //il faudrait améliorer encore ce code car le symbole ne se met pas à la fin si le nombre est en dollar par exemple.

        return $price;
    }

    public function stars($note)
    {
        // pour le moment nous mettons un simple tiret pour les étoiles vides, nous verrons plus tard comment ajouter des icônes avec une libraire CSS
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i">';
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i">';
        }

        return $html;
    }
}
