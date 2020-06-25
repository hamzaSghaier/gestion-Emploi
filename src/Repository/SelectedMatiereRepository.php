<?php

namespace App\Repository;

use App\Entity\SelectedMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SelectedMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectedMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectedMatiere[]    findAll()
 * @method SelectedMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectedMatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectedMatiere::class);
    }

    // /**
    //  * @return SelectedMatiere[] Returns an array of SelectedMatiere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SelectedMatiere
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
