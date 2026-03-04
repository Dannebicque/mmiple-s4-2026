<?php

namespace App\Repository;

use App\Entity\Jeutest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jeutest>
 */
class JeutestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jeutest::class);
    }

    //    /**
    //     * @return Jeutest[] Returns an array of Jeutest objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Jeutest
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
