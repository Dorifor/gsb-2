<?php

namespace App\Repository;

use App\Entity\PrevoirHebergement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrevoirHebergement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrevoirHebergement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrevoirHebergement[]    findAll()
 * @method PrevoirHebergement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrevoirHebergementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrevoirHebergement::class);
    }

    // /**
    //  * @return PrevoirHebergement[] Returns an array of PrevoirHebergement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrevoirHebergement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
