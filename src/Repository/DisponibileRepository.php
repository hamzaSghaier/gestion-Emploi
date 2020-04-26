<?php

namespace App\Repository;

use App\Entity\Disponibile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disponibile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disponibile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disponibile[]    findAll()
 * @method Disponibile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisponibileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disponibile::class);
    }

    // /**
    //  * @return Disponibile[] Returns an array of Disponibile objects
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
    public function findOneBySomeField($value): ?Disponibile
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
