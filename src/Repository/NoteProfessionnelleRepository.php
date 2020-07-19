<?php

namespace App\Repository;

use App\Entity\NoteProfessionnelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteProfessionnelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteProfessionnelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteProfessionnelle[]    findAll()
 * @method NoteProfessionnelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteProfessionnelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteProfessionnelle::class);
    }

    // /**
    //  * @return NoteProfessionnelle[] Returns an array of NoteProfessionnelle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteProfessionnelle
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
