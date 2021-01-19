<?php

namespace App\Repository;

use App\Entity\Deplacer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deplacer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deplacer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deplacer[]    findAll()
 * @method Deplacer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeplacerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deplacer::class);
    }

    // /**
    //  * @return Deplacer[] Returns an array of Deplacer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deplacer
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
