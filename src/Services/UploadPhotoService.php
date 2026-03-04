<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadPhotoService
{
    private $repertoireDestination;
    private $slugger;

    public function __construct(SluggerInterface $slugger) {

        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $fichier): string {
        $nomFichierOriginal = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
        $nomFichierModifie = $this->slugger->slug($nomFichierOriginal);
        $nomFichierFinal = $nomFichierModifie.'-'.uniqid().'.'.$fichier->guessExtension();

        try {
            $fichier->move($this->repertoireDestination, $nomFichierFinal);
        } catch (FileException $e) {
            throw new \Exception('Erreur lors du traitement de fichier ');
        }

        return $nomFichierFinal;
    }

    public function setRepertoireDestination(string $string)
    {
        $this->repertoireDestination = $string;
    }

}
