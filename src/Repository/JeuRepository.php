<?php

namespace App\Repository;

use App\Entity\Jeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jeu>
 */
class JeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jeu::class);
    }


    public function findByMulticritere(string $texte, float $prix, string $codePostal = '33000'): array
    {
        return $this->createQueryBuilder('j')
            ->join('j.editeur', 'e')
            ->andWhere('j.nom LIKE :val')
            ->andWhere('e.cp = :codePostal')
            ->andWhere('j.prix > :prix')
            ->setParameter('val', '%'.$texte.'%')
            ->setParameter('prix', $prix)
            ->setParameter('codePostal', $codePostal)
            ->orderBy('j.prix', 'DESC')
            ->addOrderBy('j.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
