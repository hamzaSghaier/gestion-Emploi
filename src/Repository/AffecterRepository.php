<?php

namespace App\Repository;

use App\Entity\Affecter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affecter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affecter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affecter[]    findAll()
 * @method Affecter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Affecter[]    findAllGreaterThanMatiere($value)
 */
class AffecterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affecter::class);
    }
    /**
 * @return Affecter[]
 */
    
public function findAllGreaterThanMatiere($value)
{
   return $this->createQueryBuilder('e')
    ->where('e.groupe.id = :id')
    ->setParameter('id',$value)
    ;
  
}

    // /**
    //  * @return Affecter[] Returns an array of Affecter objects
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


    
}
