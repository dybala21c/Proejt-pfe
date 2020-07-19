<?php

namespace App\Repository;

use App\Entity\Grade1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grade1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grade1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grade1[]    findAll()
 * @method Grade1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Grade1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grade1::class);
    }

    // /**
    //  * @return Grade1[] Returns an array of Grade1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grade1
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
