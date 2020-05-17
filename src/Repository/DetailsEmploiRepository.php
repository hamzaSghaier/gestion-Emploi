<?php

namespace App\Repository;

use App\Entity\DetailsEmploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailsEmploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsEmploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsEmploi[]    findAll()
 * @method DetailsEmploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsEmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsEmploi::class);
    }

    // /**
    //  * @return DetailsEmploi[] Returns an array of DetailsEmploi objects
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
    public function findOneBySomeField($value): ?DetailsEmploi
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
