<?php

namespace App\Repository;

use App\Entity\Editeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Editeur>
 */
class EditeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editeur::class);
    }

    public function findAll(): array
    {
        return $this->findBy([],['nom' => 'ASC']);
    }

    public function findByCodePostal(string $codePostal): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.cp = :codePostal')
            ->setParameter('codePostal', $codePostal)
            ->getQuery()
            ->getResult();
    }

    public function findByNom(): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
