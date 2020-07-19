<?php

namespace App\Repository;

use App\Entity\ActiviteScientifique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteScientifique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteScientifique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteScientifique[]    findAll()
 * @method ActiviteScientifique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteScientifiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteScientifique::class);
    }

    // /**
    //  * @return ActiviteScientifique[] Returns an array of ActiviteScientifique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActiviteScientifique
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
