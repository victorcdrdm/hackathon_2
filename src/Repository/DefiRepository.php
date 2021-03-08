<?php

namespace App\Repository;

use App\Entity\Defi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Defi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Defi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Defi[]    findAll()
 * @method Defi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Defi::class);
    }

    // /**
    //  * @return Defi[] Returns an array of Defi objects
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
    public function findOneBySomeField($value): ?Defi
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
